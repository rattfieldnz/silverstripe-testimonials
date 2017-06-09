<figure>
    <blockquote class="testimonial-content">
	<% if Image %>
		<% with Image.SetWidth(112) %>
			<div class="testimonial-image">	
				<img src="$URL"/>
			</div>
		<% end_with %>
	    <br>
	<% end_if %>
	<% if YoutubeVideoID %>
	<div class="testimonial-youtube-video">
	    <% include YoutubeVideo %>
	</div>	
	<br>
	<% end_if %>
	"$Content"
	</blockquote>
    <figcaption>
        <p class="testimonial-credits"><span class="dash">&#8212</span> $Credits.</p>
	</figcaption>
</figure>