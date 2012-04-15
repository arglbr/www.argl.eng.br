{% extends "skeleton_#{lang}.tpl" %}
{% block main_content %}
			<!--start holder-->
			<div class="holder_content">
				<section class="group1">
					<h3>Meu laboratório de garagem!</h3>
					<p>Bem vindo ao meu laboratório de garagem! Aqui é o lugar onde eu realizo todas as minhas experiências. Escolha uma, entenda como eu a usei, critique, faça fork, elogie e/ou fale mal. Ou não. :-)</p>
					{% for prj in projects %}
						{% include "#{prj.tplname}" %}
					{% endfor %}
				</section>

				{% include "sidebar_#{lang}.tpl" %}

			</div>
			<!--end holder-->
{% endblock %}

