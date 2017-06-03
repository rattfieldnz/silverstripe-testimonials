<figure>
    <blockquote class="testimonial-content">"$Content"</blockquote>
	<% if Image %>
		<% with Image.SetWidth(112) %>
			<div class="testimonial-image">	
				<img src="$URL"/>
			</div>
		<% end_with %>
	<% end_if %>
    <figcaption>
        <p class="testimonial-credits"><span class="dash">&#8212</span> $Credits.</p>
	</figcaption>
</figure>