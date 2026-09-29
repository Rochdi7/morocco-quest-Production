<?php

namespace Tests\Feature;

use App\Http\Middleware\CacheGuestPage;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Session\ArraySessionHandler;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

/**
 * Regression tests for the P0 fixes from the 2026-09-28 production audit.
 */
class P0SecurityFixesTest extends TestCase
{
    use RefreshDatabase;

    private const MARKER = '"><b>mqmarker</b>';

    private function makeBlog(array $attrs = []): Blog
    {
        return Blog::create($attrs + [
            'title'      => 'Sahara Desert Guide',
            'slug'       => 'sahara-desert-guide',
            'written_by' => 'Mounir',
            'summary'    => 'A guide to the Sahara.',
            'content'    => '<p>Everything about the Sahara desert.</p>',
        ]);
    }

    private function makeTour(int $i): Tour
    {
        $tour = new Tour();
        $tour->forceFill([
            'title'    => "Tour {$i}",
            'slug'     => "tour-{$i}",
            'overview' => "Overview {$i}",
            'duration_days' => 3,
        ])->save();

        return $tour;
    }

    // ---- P0-2: reflected XSS -------------------------------------------

    public function test_search_query_is_never_emitted_as_markup(): void
    {
        $response = $this->get('/search?query=' . urlencode(self::MARKER));

        $response->assertOk();
        $html = $response->getContent();
        $this->assertStringNotContainsString('<b>mqmarker', $html);
        $this->assertStringNotContainsString('"><b>', $html);
        $this->assertMatchesRegularExpression('/<meta name="keywords" content="[^"<>]*">/', $html);
        $this->assertStringNotContainsString('mqmarker', $this->keywordsTag($html));
    }

    public function test_search_bar_place_is_never_emitted_as_markup(): void
    {
        $response = $this->get('/search-bar?guests=2&place=' . urlencode(self::MARKER));

        $response->assertOk();
        $this->assertStringNotContainsString('<b>mqmarker', $response->getContent());
    }

    public function test_legitimate_search_input_is_escaped_exactly_once(): void
    {
        foreach (["l'Atlas", 'Aït Benhaddou', 'مراكش', 'Fès & Meknès', 'Tours "Sahara"'] as $term) {
            $response = $this->get('/search?query=' . urlencode($term));
            $response->assertOk();
            $html = $response->getContent();

            // Rendered once-escaped in the H1 (the browser shows the original text)…
            $this->assertStringContainsString(e($term), $html, "H1 for {$term}");
            // …and never double-escaped (&amp;#039; / &amp;quot; / &amp;amp;).
            $this->assertDoesNotMatchRegularExpression('/&amp;(#039|quot|amp);/', $html, "double escape for {$term}");
        }

        $this->makeBlog(['title' => "Guide to l'Atlas", 'slug' => 'guide-atlas', 'content' => "<p>l'Atlas</p>"]);
        $this->get('/blog/search?query=' . urlencode("l'Atlas"))->assertOk()->assertSee("Guide to l'Atlas");
    }

    public function test_array_query_parameters_do_not_500(): void
    {
        $this->get('/search?query[]=a')->assertOk();
        $this->get('/search-bar?place[]=a')->assertOk();
        $this->get('/tours?place[]=a')->assertOk();
        $this->get('/blog/search?query[]=a')->assertRedirect(route('blog.index'));
    }

    private function keywordsTag(string $html): string
    {
        preg_match('/<meta name="keywords"[^>]*>/', $html, $m);

        return $m[0] ?? '';
    }

    // ---- P0-6: /blog/search ----------------------------------------------

    public function test_blog_search_returns_200_with_and_without_results(): void
    {
        $this->makeBlog();

        $this->get('/blog/search?query=Sahara')->assertOk()->assertSee('Sahara Desert Guide');
        $this->get('/blog/search?query=zzznoresultzzz')->assertOk();
        $this->get('/blog/search?query=' . urlencode(self::MARKER))->assertOk()
            ->assertDontSee('<b>mqmarker', false);
    }

    public function test_blog_search_without_query_redirects_to_blog(): void
    {
        $this->get('/blog/search')->assertRedirect(route('blog.index'));
        $this->get('/blog/search?query=')->assertRedirect(route('blog.index'));
        $this->get('/blog/search?query=%20%20')->assertRedirect(route('blog.index'));
    }

    // ---- P0-7: /tours pagination -----------------------------------------

    public function test_tours_listing_and_out_of_range_pages(): void
    {
        $this->makeTour(1);

        $this->get('/tours')->assertOk()->assertSee('Tour 1');
        $this->get('/tours?page=1')->assertOk();
        $this->get('/tours?page=2')->assertNotFound();
        $this->get('/tours?page=99')->assertNotFound();
    }

    public function test_tours_page_two_renders_when_it_has_tours(): void
    {
        foreach (range(1, 9) as $i) {
            $this->makeTour($i);
        }

        $this->get('/tours?page=2')->assertOk();
        $this->get('/tours?page=3')->assertNotFound();
    }

    // ---- P0-3: comment moderation ------------------------------------------

    private function commentPayload(array $overrides = []): array
    {
        return $overrides + [
            'content' => 'Great article, thanks!',
            'name'    => 'Jane Visitor',
            'email'   => 'jane@example.com',
        ];
    }

    public function test_new_comment_is_stored_pending_and_not_shown(): void
    {
        $blog = $this->makeBlog();

        $this->post(route('comments.store', $blog->id), $this->commentPayload())
            ->assertRedirect()
            ->assertSessionHas('success');

        $comment = Comment::firstOrFail();
        $this->assertFalse($comment->is_approved);

        $this->get('/blog/' . $blog->slug)->assertOk()->assertDontSee('Great article, thanks!');
    }

    public function test_visitor_cannot_self_approve(): void
    {
        $blog = $this->makeBlog();

        $this->post(route('comments.store', $blog->id), $this->commentPayload(['is_approved' => 1]));

        $this->assertFalse(Comment::firstOrFail()->is_approved);
    }

    public function test_only_approved_comments_render(): void
    {
        $blog = $this->makeBlog();
        $approved = Comment::create(['blog_id' => $blog->id, 'name' => 'A', 'email' => 'a@a.test', 'content' => 'Approved comment text', 'is_approved' => true]);
        Comment::create(['blog_id' => $blog->id, 'name' => 'S', 'email' => 's@s.test', 'content' => 'Pending spam text']);
        Comment::create(['blog_id' => $blog->id, 'parent_id' => $approved->id, 'name' => 'R', 'email' => 'r@r.test', 'content' => 'Pending reply text']);

        $this->get('/blog/' . $blog->slug)
            ->assertOk()
            ->assertSee('Approved comment text')
            ->assertDontSee('Pending spam text')
            ->assertDontSee('Pending reply text');
    }

    public function test_honeypot_submission_is_silently_dropped(): void
    {
        $blog = $this->makeBlog();

        $this->post(route('comments.store', $blog->id), $this->commentPayload(['website' => 'http://spam.test']))
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertSame(0, Comment::count());
    }

    public function test_reply_to_unapproved_comment_is_rejected(): void
    {
        $blog = $this->makeBlog();
        $pending = Comment::create(['blog_id' => $blog->id, 'name' => 'S', 'email' => 's@s.test', 'content' => 'spam']);

        $this->post(route('blog.comments.reply', $pending->id), $this->commentPayload())->assertNotFound();

        $approved = Comment::create(['blog_id' => $blog->id, 'name' => 'A', 'email' => 'a@a.test', 'content' => 'ok', 'is_approved' => true]);
        $this->post(route('blog.comments.reply', $approved->id), $this->commentPayload())->assertRedirect();
        $this->assertFalse(Comment::where('parent_id', $approved->id)->firstOrFail()->is_approved);
    }

    public function test_comment_validation_rejects_oversized_content(): void
    {
        $blog = $this->makeBlog();

        $this->post(route('comments.store', $blog->id), $this->commentPayload(['content' => str_repeat('x', 3001)]))
            ->assertSessionHasErrors('content');
        $this->assertSame(0, Comment::count());
    }

    public function test_comment_endpoint_is_rate_limited(): void
    {
        $blog = $this->makeBlog();

        foreach (range(1, 5) as $i) {
            $this->post(route('comments.store', $blog->id), $this->commentPayload(['content' => "Comment {$i}"]))->assertRedirect();
        }

        $this->post(route('comments.store', $blog->id), $this->commentPayload())->assertStatus(429);
    }

    // ---- P0-4: page cache must not store/serve visitor form state ------------

    private function runCacheMiddleware(callable $prepareSession, string $body): \Symfony\Component\HttpFoundation\Response
    {
        $session = new Store('test', new ArraySessionHandler(10));
        $prepareSession($session);

        $request = Request::create('/dmc-marrakech', 'GET');
        $request->setLaravelSession($session);

        return (new CacheGuestPage())->handle($request, fn () => response($body, 200, ['Content-Type' => 'text/html; charset=UTF-8']));
    }

    public function test_page_cache_bypassed_when_session_has_validation_errors_or_old_input(): void
    {
        Cache::flush();
        $key = 'page-cache:' . sha1('dmc-marrakech');

        $cases = [
            'errors'    => fn (Store $s) => $s->put('errors', (new ViewErrorBag())->put('default', new MessageBag(['email' => 'bad']))),
            'old input' => fn (Store $s) => $s->put('_old_input', ['name' => 'Private Person', 'email' => 'p@p.test']),
            'any flash' => function (Store $s) { $s->put('form_type', 'dmc'); $s->put('_flash.old', ['form_type']); },
            'success'   => fn (Store $s) => $s->put('success', 'sent'),
        ];

        foreach ($cases as $label => $prepare) {
            $response = $this->runCacheMiddleware($prepare, "<html>{$label} Private Person</html>");
            $this->assertFalse($response->headers->has('X-Page-Cache'), "{$label}: must bypass cache");
            $this->assertFalse(Cache::has($key), "{$label}: must not write the cache");
        }
    }

    public function test_one_visitors_form_data_never_reaches_another_visitor(): void
    {
        Cache::flush();

        // Visitor A comes back from a failed DMC enquiry: the page renders their old() input.
        $a = $this->runCacheMiddleware(
            function (Store $s) {
                $s->put('_old_input', ['name' => 'Alice Private', 'email' => 'alice@private.test', 'phone' => '+212600000000']);
                $s->put('errors', (new ViewErrorBag())->put('default', new MessageBag(['phone' => 'invalid'])));
                $s->put('_flash.old', ['_old_input', 'errors']);
            },
            '<html><input value="Alice Private"><input value="alice@private.test"><input value="+212600000000"></html>'
        );
        $this->assertStringContainsString('Alice Private', $a->getContent());

        // Visitor B, clean session, same URL: must get a fresh render, never A's page.
        $b = $this->runCacheMiddleware(fn () => null, '<html><input value=""></html>');
        $this->assertSame('miss', $b->headers->get('X-Page-Cache'));
        foreach (['Alice Private', 'alice@private.test', '+212600000000'] as $pii) {
            $this->assertStringNotContainsString($pii, $b->getContent());
        }

        // And B's clean render is what later visitors get from the cache.
        $c = $this->runCacheMiddleware(fn () => null, '<html>unused</html>');
        $this->assertSame('hit', $c->headers->get('X-Page-Cache'));
        $this->assertStringNotContainsString('Alice', $c->getContent());
    }

    public function test_page_cache_still_works_for_clean_sessions(): void
    {
        Cache::flush();

        $miss = $this->runCacheMiddleware(fn () => null, '<html>clean</html>');
        $this->assertSame('miss', $miss->headers->get('X-Page-Cache'));

        $hit = $this->runCacheMiddleware(fn () => null, '<html>should not render</html>');
        $this->assertSame('hit', $hit->headers->get('X-Page-Cache'));
        $this->assertSame('<html>clean</html>', $hit->getContent());
    }
}
