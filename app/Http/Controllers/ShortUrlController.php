<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $urls = ShortUrl::with(['user', 'company'])->get();
        }

        if ($user->isAdmin()) {
            $urls = ShortUrl::with(['user', 'company'])
                ->where('company_id', $user->company_id)
                ->get();
        }

        if ($user->isMember()) {
            $urls = ShortUrl::with(['user', 'company'])
                ->where('user_id', $user->id)
                ->get();
        }

        return view('shorturls.index', compact('urls'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->isSuperAdmin()) {
            abort(403);
        }

        $request->validate([
            'original_url' => 'required|url',
        ]);

        ShortUrl::create([
            'code' => strtoupper(Str::random(6)),
            'original_url' => $request->original_url,
            'user_id' => $user->id,
            'company_id' => $user->company_id,
        ]);

        return redirect()->route('shorturls.index')
            ->with('success', 'Short URL created');
    }

    public function redirect($code)
    {
        $url = ShortUrl::where('code', $code)->firstOrFail();

        return redirect()->away($url->original_url);
    }
}
