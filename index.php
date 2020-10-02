<?php require_once(__DIR__.'/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Библиотека</title>
    <script type="text/javascript" src="js/jquery.js"></script>

</head>
<body>
<style>
    table{
        width:100%;
        border:2px solid white;
        background:#636363;
    }
    table td{
        border:2px solid white;
    }
    body{
        background:url('img/fon.jpg') left top no-repeat;

        background-size:cover;
        border-color:white !important;
        color:white;
    }
</style>
<h2>
    Книги
</h2>
<table style="text-align: center">
    <tr>
        <th>
            шифр
        </th>
        <th>
           автор
        </th>
        <th>
            название
        </th>
        <th>
            год издания
        </th>
        <th>
            издательство
        </th>
        <th>
            количество страниц
        </th>
        <th>
            количество имеющихся на абонементе экземпляров
        </th>
        <th>
            количество выданных книг
        </th>
        <th >
           Выдача книги
        </th>
        <th>
           удаление
        </th>
    </tr>
    <tbody>
    <?php
    foreach (books() as $item){
        ?>
    <tr data-id="<?php echo htmlspecialchars($item['id']); ?>" class="tr">
        <td>
            <?php
                echo htmlspecialchars($item['id']);
                ?>
        </td>
        <td contenteditable="true" class="edit_books avtor" id="avtor">

            <?php
            echo htmlspecialchars($item['avtor']);
            ?>

        </td>
        <td contenteditable="true"  class="edit_books title" id="title">

            <?php
            echo htmlspecialchars($item['title']);
            ?>
        </td>
        <td contenteditable="true" class="edit_books" id="date">
            <?php
            echo htmlspecialchars($item['date']);
            ?>

        </td>
        <td contenteditable="true" class="edit_books" id="description">
            <?php
            echo htmlspecialchars($item['description']);
            ?>
        </td>
        <td contenteditable="true" class="edit_books" id="page_count">
            <?php
            echo htmlspecialchars($item['page_count']);
            ?>
        </td>
        <td contenteditable="true" class="edit_books" id="count_books">
            <?php
            echo htmlspecialchars($item['count_books']);
            ?>
        </td>
        <td >
            <?php
            echo htmlspecialchars($item['issued']);
            ?>
        </td>
        <td>
            <form action="handlers.php" method="post">
                <input type="hidden" name="readers" class="issuing_readers"/>
                <input type="hidden" name="issued" value="<?php echo htmlspecialchars($item['issued']); ?>"/>
                <button type="submit" name="issuing_books" value="<?php echo $item['id']; ?>">
                    Выдать книгу
                </button>
            </form>
        </td>
        <td>
            <form action="handlers.php" method="post">
                <button type="submit" name="delete" value="<?php echo $item['id']; ?>">
                    удалить
                </button>
            </form>
        </td>
    </tr>

    <?php
    }
    ?>
    </tbody>
</table>

<form action="handlers.php" method="post">
        <button name="add" value="1">
        Добавить книгу
    </button>
</form>

<label for="">Поиск по автору</label>

<input  id="search" type="text" placeholder="Поиск">

<label for="">Поиск по названию книги</label>

<input  id="search2" type="text" placeholder="Поиск">
<label for="">Кому выдать книгу</label>
<select id="readers_book">
    <?php foreach(readers() as $item) { ?>
        <option value="<?php echo (int)$item['id']; ?>"><?php echo htmlspecialchars($item['name']); ?></option>
    <?php } ?>
</select>
<br>
<br>
<br>
<br>
<?php
require_once(__DIR__."/vydan.php");
require_once(__DIR__."/statist.php");
?>
<script>
    $('#readers_book').on('change', function(){
        issuing_books();
    });
    function issuing_books(){
     $('.issuing_readers').val($('#readers_book').val());

    }
    issuing_books();
    $(".edit_books").on('blur', function(){
        var id = $(this).parent().data('id');
            field = $(this).attr('id'),
            text = $(this).text();

        $.ajax({
            url: 'handlers.php',
            method: 'post',
            data: {'update':1,'id':id,'field':field,'text':text.trim()},
            success: function(data){
                console.log('ok');
            },error: function(){
                console.log('Ошибка ответа от сервера');
            }
        });
    });
    $(".edit_readers").on('blur', function(){
        var id = $(this).parent().data('id');
        field = $(this).attr('id'),
        text = $(this).text();

        $.ajax({
            url: 'handlers.php',
            method: 'post',
            data: {'update_readers':1,'id':id,'field':field,'text':text.trim()},
            success: function(data){
                console.log('Ок');
            },error: function(){
                console.log('Ошибка ответа от сервера');
            }
        });
    });

    $("#search").on('keyup', function(){
        var search = $(this).val().trim();
        if(search === ''){
            $('.tr').fadeIn(0);
            return false;
        }
        $('.tr').fadeOut(0);
        $('tbody tr .avtor').each(function(key,elem){
        var au = elem.innerHTML.trim().toLocaleLowerCase();
            if(au.indexOf(search.toLocaleLowerCase())  === 0){
               $(elem).parent().fadeIn(0);

            }
        });

    });
    $("#search2").on('keyup', function(){
        var search = $(this).val().trim();
        if(search === ''){
            $('.tr').fadeIn(0);
            return false;
        }
        $('.tr').fadeOut(0);
        $('tbody tr .title').each(function(key,elem){
            var au = elem.innerHTML.trim().toLocaleLowerCase();
            if(au.indexOf(search.toLocaleLowerCase())  === 0){
                $(elem).parent().fadeIn(0);

            }
        });

    });
</script>
</body>
</html>


















