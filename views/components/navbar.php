<nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand ms-3" href="/">Служба проката автомобилей</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-3" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-3 me-3 mt-1">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Главная</a>
                </li>
                <?php
                if(!$_SESSION['user']){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="/login">Вход</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/register">Регистрация</a>
                    </li>
                    <?php
                }
                else{
                ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="/profile">Личный кабинет</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/pay">Ваш баланс:
                            <?php if(isset($_SESSION['userPrice'])){
                                echo $_SESSION['userPrice']['price'];
                            }
                            else{
                                echo '0';
                            }

                            ?>руб. </a>
                    </li>
                    <form action="/auth/logout" method="post">
                        <li class="nav-item">
                            <button type="submit" class="btn btn-outline-danger btn-sm mt-1 ms-3">Выйти</button>
                        </li>
                    </form>

                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>