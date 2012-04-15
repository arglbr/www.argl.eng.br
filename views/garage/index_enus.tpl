{% extends "skeleton_#{lang}.tpl" %}
{% block main_content %}
			<!--start holder-->
			<div class="holder_content">
				<section class="group1">
					<h3>My garage lab!</h3>
					<p>Welcome to my garage lab! Here is the place where I do all my experiences. Pick one, understand how I did use, make criticism, fork it, make some praise and/or comment. Or don't. :-)</p>
					{% for prj in projects %}
						{% include "#{prj.tplname}" %}
					{% endfor %}
				</section>

				{% include "sidebar_#{lang}.tpl" %}

			</div>
			<!--end holder-->
{% endblock %}
