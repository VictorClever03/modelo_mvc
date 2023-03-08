<?php
//  require '../app/Libraries/Uploads.php';
use App\Libraries\uploads;
if (isset($_FILES['upload'])) :
   
    $up = new  uploads();
    $up->imagem($_FILES['upload']);
    $up->getexito()? print $up->getexito():print $up->geterro();
    echo"<hr>";
    var_dump($up);
    echo"<hr>";

endif;


// var_dump($_FILES);
// echo"<br><hr>";
// // deletando arquivos
// // if(file_exists('../public/uploads/28822IMG_0052.JPG')):
// // unlink('../public/uploads/28822IMG_0052.JPG');
// // // rmdir('../public/uploads/delete');
// //     echo"Deletado com sucesso";
// // endif;
// if(isset($_FILES['upload'])):
//     $diretorio='../public/uploads/';
//     $arquivo=date('dny').$_FILES['upload']['name'];
//     $arquivo0=$_FILES['upload']['tmp_name'];
//     $tipo=$_FILES['upload']['type'];
//     $tamanho=$_FILES['upload']['size'];

//     $extensoesValidas=['png','jpg','mp3'];
//     $tiposValidas=['image/jpeg','image/png','text/plain','audio/mpeg'];

//     $extensao=pathinfo($arquivo, PATHINFO_EXTENSION);
//     var_dump(strtolower($extensao));
//     if(!in_array(strtolower($extensao),$extensoesValidas)):

//         echo"ext INVALIDO";

//     elseif(!in_array(strtolower($tipo),$tiposValidas)):
//         echo"Tipo invalido";

//     elseif($tamanho > 7 * (1024*1024)):
//         echo"tamanho invalido";

//     else:

//        if(!file_exists($diretorio)&& !is_dir($diretorio)):
//         mkdir($diretorio,0777);
//     endif;

//     if(file_exists($diretorio.$arquivo)):

//         $nome=pathinfo($arquivo, PATHINFO_FILENAME);

//         $arquivo=$nome.'-'.uniqid().strrchr($arquivo, '.');

//     endif;

//     if(move_uploaded_file($arquivo0,$diretorio.$arquivo)):
//     echo"sucesso";
//     else:
//         echo"erro";
//     endif;

//     endif;


// endif;
// echo"<br><hr>";
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="upload" id="upload">
    <input type="submit" value="submeter">
</form>
