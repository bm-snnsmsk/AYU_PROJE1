<?php Router::view('static/header') ; ?> 
<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">                                              
                    <div class="col col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-900 mb-4">Hastane Randevu Sistemine Hoşgeldiniz</h1>
                            </div>
                            <?php
                                echo isset($_SESSION['error']) ? '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>' : null ;
                            ?>
                            <form action="<?= 'login' ; ?>" method="POST" id="loginform">
                                <div class="form-group">
                                    <input type="text" name="tcnumber" class="form-control form-control-user"
                                        id="tcnumber" aria-describedby="emailHelp" value="<?= $_SESSION['tckimlikno'] ?? '' ; ?>"
                                        placeholder="TC Kimlik Numarası">                                        
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Şifre">
                                       
                                </div>                                      
                                
                                <button name="oturumac" class="btn btn-primary btn-user btn-block" id="oturumac">Giriş <span class="myload"></span></button>
                                <hr>
                                <div class="d-flex justify-content-between "><a href="signup">Kayıt Ol</a>
                                <a href="<?= Router::url('forgetpassword') ; ?>">Şifremi Unuttum</a></div>
                            </form>                                   
                        </div>                          
                    </div>               
                </div>
            </div>
        </div>
    </div>
</body>
</html>

