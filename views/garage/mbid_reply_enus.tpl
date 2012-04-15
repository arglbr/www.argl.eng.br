{% extends "skeleton_#{lang}.tpl" %}
{% block main_content %}
			<!--start holder-->
			<div class="holder_content">
				<section class="group1">
					<h3>Mozilla BrowserID return</h3>
					<script>
						function doLogout()
						{
							window.location.href = "/doMozLogout";
						}
					</script>
					<p>The authentication mechanism from Mozilla BrowserID brings a JSON string as response for a validation request. An example decoded JSON string follows below:</p>
					<p><pre>{{ret_str}}</pre></p>
					<h4>... and the logout proccess?</h4>
					<p>The unique way I've found to do logout was nulling all the related session variables. The link below will do the logout and you'll realize it trying sign in again:</p>
					<p><a href="#"><img src="/images/mozl_sign_out_door.png" alt="Sign out!" title="Sign out!" onclick="doLogout();"/></a></p>
				</section>

				{% include "sidebar_#{lang}.tpl" %}

			</div>
			<!--end holder-->
{% endblock %}

