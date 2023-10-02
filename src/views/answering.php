<main class="container">
    <ul class="answering-list">
        <?php
        require_once "../models/exercise.php";
        $menuItems = getAllExercises();
        // Loop through each menu item and render them
        foreach ($menuItems as $menuItem) {
            echo '<li class="row">
                        <div class="column card">
                            <div class="title">' . htmlspecialchars($menuItem['title']) . '</div>
                            <a class="button" href="' . htmlspecialchars($menuItem['url']) . '">Take it</a>
                        </div>
                      </li>';
        }

        ?>
    </ul>
</main>
