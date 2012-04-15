{% extends "skeleton_#{lang}.tpl" %}
{% block main_content %}
			<!--start holder-->
			<div class="holder_content">
				<section class="group1">
					<h3>My garage lab</h3>
					<p>Na minha garagem você verá em ação códigos que eu tenha discutido e/ou que eu quis oferecer ao vivo para você.</p>
					<div class="button black">
						<a href="/garage">Acesse-a aqui!</a>
					</div>
				</section>

				{% include "sidebar_#{lang}.tpl" %}

				<section class="group3">
					<h3>Último post no blog</h3>
					<article class="holder_gallery">
						<h4>{{blog.title}}</h4>
						<p>{{blog.content}}</p>
						<span class="readmore"><a href="http://blog.argl.eng.br/pt/{{blog.url}}">Continue lendo...</a></span>
					</article>
				</section>
			</div>
			<!--end holder-->
{% endblock %}

