<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
    <input class="searchform_input" type="text" value="<?php echo get_search_query() ?>" name="s" id="s"
        placeholder="Поиск" />
    <input type="submit" id="searchsubmit" value="найти" />
</form>
