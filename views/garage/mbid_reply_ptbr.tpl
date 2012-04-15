{% extends "skeleton_#{lang}.tpl" %}
{% block main_content %}
			<!--start holder-->
			<div class="holder_content">
				<section class="group1">
					<h3>Retorno do Mozilla BrowserID</h3>
					<script>
						function doLogout()
						{
							window.location.href = "/doMozLogout";
						}
					</script>
					<p>O mecanismo de autenticação da Mozilla retorna uma string JSON como resposta para validação da requisição. Abaixo, uma resposta JSON:</p>
					<p><pre>{{ret_str}}</pre></p>
					<h4>... e o processo de logout?</h4>
					<p>A única forma que encontrei de fazer logout foi invalidando a sessão do usuário. O link abaixo fará o logout e você perceberá isso se tentar fazer login novamente:</p>
					<p><a href="#"><img src="/images/mozl_sign_out_door.png" alt="Sign out!" title="Sign out!" onclick="doLogout();"/></a></p>
				</section>

				{% include "sidebar_#{lang}.tpl" %}

			</div>
			<!--end holder-->
{% endblock %}

