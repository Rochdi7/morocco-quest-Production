{{-- Spam honeypot for blog comment/reply forms. Off-screen (not display:none,
     which many bots skip) and removed from tab order / accessibility tree.
     Humans never fill it; CommentController::isHoneypotHit() silently drops
     any submission where it is filled. Inline style so PurgeCSS can't strip it. --}}
<div aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
    <label>Leave this field empty
        <input type="text" name="website" value="" tabindex="-1" autocomplete="off">
    </label>
</div>
