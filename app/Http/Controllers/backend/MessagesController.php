<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\ApplicationStatus;
use App\Models\ApplyJob;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MessagesController extends Controller
{
    public function index()
    {
        return view('livewire.backend.chat.index');
    }
}
