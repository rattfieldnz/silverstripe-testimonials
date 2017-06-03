<h1 class="pagetitle">$Title</h1>
$Content
$Form

<% if $PaginatedTestimonials %>
	<div id="Testimonials" class="page">
		<% loop $PaginatedTestimonials %>
			<div id="Testimonial$ID" class="testimonial <% if Image %>image<% end_if %>">
				<% include TestimonialFull %>
				<div class="clear"><!--  --></div>
			</div>
		<% end_loop %>
        
        <% with $PaginatedTestimonials %>
            <p>
                <% if $MoreThanOnePage %>
                    <% if $NotFirstPage %>
                        <a class="prev" href="$PrevLink">Prev</a>
                    <% end_if %>
                    
                    <% loop $Pages %>
                        <% if $CurrentBool %>
                            $PageNum
                        <% else %>
                            <% if $Link %>
                                <a href="$Link">$PageNum</a>
                            <% else %>
                                ...
                            <% end_if %>
                        <% end_if %>
                    <% end_loop %>
                    
                    <% if $NotLastPage %>
                        <a class="next" href="$NextLink">Next</a>
                    <% end_if %>
                <% end_if %>
            </p>
        <% end_with %>
	</div>
<% end_if %>
