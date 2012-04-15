
                    <h4>Mozilla BrowserID</h4>
                    <script src="https://browserid.org/include.js" type="text/javascript"></script>
                    <script>
                        function doLogin()
                        {
                            navigator.id.get(
                                function(assertion)
                                {
                                    if (assertion)
                                    {
                                        document.getElementById('hid_value1').value = assertion;
                                        document.getElementById('frmMozLogin').submit();
                                    }
                                    else
                                    {
                                        alert('A tentativa de login falhou.');
                                    }
                                });
                        }
                    </script>
                    <p>Aqui eu testei o mecanismo oferecido pela <a href="http://mozillalabs.com/">Mozilla Labs</a>.</p>
                    <p><a href="#"><img src="/images/mozl_sign_in_green.png" alt="Login!" title="Login!" onclick="doLogin();"/></a></p>
                    <p>&nbsp;</p>
                    <form name="frmMozLogin" id="frmMozLogin" method="POST" action="/doAuth">
                        <input type="hidden" name="hid_value1" id="hid_value1" value="0" />
                    </form>

