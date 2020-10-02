<h1>Статистика популярности книг</h1>
<table border="1" style="text-align: center">
    <tr>
        <th>
            Место по популярности
        </th>
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
            востребовательность
        </th>
    </tr>
    <tbody>
    <?php
    $i=1;
    foreach (books_static() as $item){
        ?>
        <tr >
            <td>
                <?php
                echo $i;
                ?>
            </td>
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
                <?php if((int)$item['issued'] > 0) { ?>
                  Книга пользуется спросом
                <?php }else{ ?>
                    Книга не выдавалась
                <?php } ?>
            </td>
        </tr>
        <?php
    $i++; }
    ?>
    </tbody>
</table>
<br>
<!--<label for="">За период</label>
<input type="date" name="start_date" placeholder="Укажите начальное время">
<input type="date" name="end_date" placeholder="Укажите конечное  время" value="<?php /*echo date("Y-m-d"); */?>">
<script>

    $("input[name='start_date'], input[name='end_date']").on('change', function(){
        var date = new Date();
        var year = date.getFullYear()  < 9 ? "0"+date.getFullYear() : date.getFullYear(),
            mounth = date.getMonth() < 9 ? "0"+(parseInt(date.getMonth())+1) :(parseInt(date.getMonth())+1),
            day = date.getDate()  < 9 ? "0"+date.getDate() : date.getDate();
        var time = year+"-"+mounth+"-"+day;
        console.log($("input[name='end_date']").val(),time);
        if($("input[name='start_date']").val() == time || $("input[name='end_date']").val()  == time){
            alert('Указанная дата еще не наступила');
        }

    });
</script>-->
<h1>Читатели должники</h1>
<table border="1" style="text-align: center">
    <tr>
        <th>
            Название книги
        </th>
        <th>
            Читатель
        </th>
        <th>
            Дата приема
        </th>
    </tr>
    <tbody>
    <?php
    foreach (issuing_books() as $item){
        if((int)$item['status'] === 1) {
        ?>
        <tr >
            <td  >

                <?php
                echo htmlspecialchars($item['title_book']);
                ?>

            </td>
            <td   >

                <?php
                echo htmlspecialchars($item['reader']);
                ?>
            </td>
            <td >
                <?php
                echo htmlspecialchars($item['date']);
                ?>
            </td>
        </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>
