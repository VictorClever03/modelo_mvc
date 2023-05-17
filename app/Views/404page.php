<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page not found</title>
    <style>
        body {
            font-family: DM Sans;
            margin-inline: auto;
            text-align: center;

        }

        h1 {
            font-size: 180px;
            font-weight: 700;
            color: #181926;
            margin: 2rem 0 0 0;
            line-height: 150px;
        }

        h2 {
            color: #4154f1;
        }
        a{
            text-decoration: none;
        }
        .btn {
            color: #fff;
            background: #4154f1;
            padding: 8px 30px;
            border-radius: .3rem;
        }

        @media (min-width: 992px) {
            img {

                max-width: 50%;
            }
        }
    </style>
</head>

<body>
    <main>
        <div class="container">

            <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <h1>404</h1>
                <h2>A página requerida não existe no nosso servidor.</h2>
                <a class="btn" href="<?= URL ?>">Retorne</a><br>
                <img src="<?= asset("img/not-found.svg") ?>" class="img-fluid py-5" alt="Page Not Found">
                <div class="credits">
                    Made by Victor Clever
                </div>
            </section>

        </div>
    </main>
</body>

</html>