<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Blog;
use App\Models\Comment;


class CommentController extends Controller
{
    /**
     * Shown after every public submission — including silently dropped
     * honeypot hits, so bots get no signal that they were filtered.
     */
    public const PENDING_MESSAGE = 'Thank you! Your comment has been received and will appear once it has been reviewed.';

    /**
     * Server-side rules shared by new comments and replies.
     */
    public static function rules(): array
    {
        return [
            'content' => 'required|string|min:2|max:3000',
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:255',
        ];
    }

    /**
     * Honeypot: the "website" field is visually hidden in the form, so a
     * filled value means an automated submission.
     */
    public static function isHoneypotHit(Request $request): bool
    {
        return filled($request->input('website'));
    }

    public function show($id)
    {
        // Get all parent comments and their nested replies
        $comments = Comment::where('blog_id', $id)
            ->whereNull('parent_id')
            ->where('is_approved', true)
            ->with(['replies' => fn ($q) => $q->where('is_approved', true)])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('blog.show', compact('comments'));
    }

    public function store(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if (self::isHoneypotHit($request)) {
            return redirect()->back()->with('success', self::PENDING_MESSAGE);
        }

        $request->validate(self::rules() + [
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('comments', 'id')
                    ->where('blog_id', $blog->id)
                    ->where('is_approved', true),
            ],
        ]);

        // is_approved is not fillable and defaults to false: every public
        // comment waits for moderation in Filament before it is shown.
        Comment::create([
            'parent_id' => $request->parent_id,
            'blog_id' => $blog->id,
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', self::PENDING_MESSAGE);
    }
}
