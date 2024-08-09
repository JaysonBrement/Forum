<?php ob_start() ?> 
<div class="categories">
    <div class="category-rectangle general-discussion"><a href="">General Discussion</a></div>
    <div class="category-rectangle technology"><a href="">Technology</a></div>
    <div class="category-rectangle entertainment"><a href="">Entertainment</a></div>
    <div class="category-rectangle health"><a href="">Health</a></div>
    <div class="category-rectangle travel"><a href="">Travel</a></div>
    <div class="category-rectangle sports"><a href="">Sports</a></div>
    <div class="category-rectangle food"><a href="">Food</a></div>
    <div class="category-rectangle arts"><a href="">Arts</a></div>
    <div class="category-rectangle science"><a href="">Science</a></div>
    <div class="category-rectangle education"><a href="">Education</a></div>
    <div class="category-rectangle relationships"><a href="">Relationships</a></div>
    <div class="category-rectangle gaming"><a href="">Gaming</a></div>
    <div class="category-rectangle politics"><a href="">Politics</a></div>
    <div class="category-rectangle environment"><a href="">Environment</a></div>
    <div class="category-rectangle off-topic"><a href="">Off-Topic</a></div>
</div>


<?php
$content =ob_get_clean();
require "template.php";
?>  