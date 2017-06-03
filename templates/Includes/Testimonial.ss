<figure>
    <% if Image %>
        <% with Image.SetWidth(112) %>
            <div class="image">
                <img src="$URL"/>
            </div>
        <% end_with %>
    <% end_if %>
    <blockquote>"$TestimonialContent"</blockquote>
    <figcaption>
	    <p>&#8212 $Credits. </p>
		<p><a href="$Link">Read more...</a></p>
	</figcaption>
</figure>