<style>
    .er{
        background:#f00;
        color:white;
    }
</style>
<h2>
   Читатели
</h2>
<table border="1" style="text-align: center">
    <tr>
        <th>
            ФИО
        </th><th>
            адрес
        </th><th>
            телефон
        </th>

        <th>
            удаление
        </th>
    </tr>
    <tbody>
    <?php
    foreach (readers() as $item){
        ?>
        <tr data-id="<?php echo htmlspecialchars($item['id']); ?>" class="tr">

            <td contenteditable="true" class="edit_readers" id="name">

                <?php
                echo htmlspecialchars($item['name']);
                ?>

            </td>
            <td contenteditable="true"  class="edit_readers" id="adress">

                <?php
                echo htmlspecialchars($item['adress']);
                ?>
            </td>
            <td contenteditable="true" class="edit_readers" id="telefon">
                <?php
                echo htmlspecialchars($item['telefon']);
                ?>

            </td>
            <td>
                <form action="handlers.php" method="post">
                    <button type="submit" name="delete_readers" value="<?php echo $item['id']; ?>">
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
    <button name="add_readers" value="1">
        Добавить читателя
    </button>
</form>
<h2>Информация о выдачах книг</h2>
<table border="1" style="text-align: center">
    <tr>
        <th>
            Название книги
        </th>
        <th>
            Читатель
        </th>
        <th>
            Дата приема или сдачи
        </th>
        <th>
            Распечатать
        </th>
        <th>
            Статус
        </th>
    </tr>
    <tbody>
    <?php
    foreach (issuing_books() as $item){
        ?>
        <tr data-id="<?php echo htmlspecialchars($item['id']); ?>" class="tr <?php if((int)$item['status'] === 0) echo 'er'; ?>" >
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
            <td>
                <button onclick="window.open('http://library/print.php?=<?php echo $item['id']; ?>');">
                    Печать
                </button>
            </td>
            <td>
                <?php
                if((int)$item['status'] === 0) { ?>
                    Книга сдана
                <?php  }  else{ ?>
                    <form action="handlers.php" method="post">
                        <input type="hidden" name="book_id" value="<?php echo $item['id_books']; ?>" >
                        <button name="status_issuing" value="<?php echo $item['id']; ?>">
                            Сдать книгу
                        </button>
                    </form>
                <?php } ?>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>


