<% if Image %>
    <% with Image.SetWidth(112) %>
        <div class="image">
            <img src="$URL"/>
        </div>
    <% end_with %>
<% end_if %>
<div class="text">
    <figure>
       <blockquote>"$Content"</blockquote>
       <figcaption>&#8212 $getStaticCredits<% if Business %>, of $Business<% end_if %>.</figcaption>
    </figure>
</div>
<div class="clear"></div>