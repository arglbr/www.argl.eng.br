{% extends "skeleton_#{lang}.tpl" %}
{% block main_content %}
			<!--start holder-->
			<div class="holder_content">
				<section class="group1">
					<h3>My garage lab</h3>
					<p>At my garage, you'll be able to test codes I've discussed or I'd like to bring live to you.</p>
					<div class="button black">
						<a href="/garage">Access it here!</a>
					</div>
				</section>

				{% include "sidebar_#{lang}.tpl" %}

				<section class="group3">
					<h3>Last blog entry</h3>
					<article class="holder_gallery">
						<h4>{{blog.title}}</h4>
						<p>{{blog.content}}</p>
						<span class="readmore"><a href="http://blog.argl.eng.br/en/{{blog.url}}">Read more...</a></span>
					</article>
				</section>
			</div>
			<!--end holder-->
{% endblock %}
