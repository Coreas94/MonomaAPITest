<?php

namespace App\Http\Controllers;


use App\Models\Lead;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\LeadRequest;
use App\Http\Resources\LeadCollection;
use App\Http\Resources\LeadResource;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\LeadRepository;

class LeadController extends Controller
{
    protected $leadRepository;

    public function __construct(LeadRepository $leadRepository)
    {
        $this->middleware('auth:api');
        $this->leadRepository = $leadRepository;
    }

    public function store(LeadRequest $request)
    {
        $currentUser = Auth::user();
        if ($currentUser->role != 'manager') {
            return response()->json([
                'meta' => ['success' => false, 'errors' => ['Unauthorized']]
            ], 401);
        }

        $lead = $this->leadRepository->create([
            'name' => $request->name,
            'source' => $request->source,
            'owner' => $request->owner,
            'created_by' => $currentUser->id,
        ]);

        return response()->json([
            'meta' => ['success' => true, 'errors' => []],
            'data' => $lead
        ], 201);
    }

    public function show($id)
    {
        $lead = $this->leadRepository->find($id);
        if (!$lead) {
            return response()->json([
                'meta' => ['success' => false, 'errors' => ['No lead found']]
            ], 404);
        }

        return response()->json([
            'meta' => ['success' => true, 'errors' => []],
            'data' => new LeadResource($lead)
        ], 200);
    }

    public function index()
    {
        $currentUser = Auth::user();
        $cacheKey = $currentUser->role == 'manager' ? 'leads_all' : 'leads_currentUser_' . $currentUser->id;

        $leads = Cache::remember($cacheKey, 60, function () use ($currentUser) {
            if ($currentUser->role == 'manager') {
                return $this->leadRepository->all();
            } else {
                return $this->leadRepository->all()->where('owner', $currentUser->id);
            }
        });

        return new LeadCollection($leads);
    }
}
