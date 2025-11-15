
<?php
$filters = $args['filters'] ?? [];
$variant = $args['variant'] ?? 'desktop';
?>

<?php if ( $variant === 'desktop' ) : ?>
    <nav class="filter-menu hidden md:flex">
        <?php foreach ( $filters as $filter ) : ?>
            <a href="#"
               class="filter-menu-items"
               data-category="<?php echo esc_attr( $filter['slug'] ); ?>">
                <?php echo esc_html( $filter['label'] ); ?>
            </a>
        <?php endforeach; ?>
    </nav>
<?php else : ?>
    <div class="md:hidden relative">
        <button
            id="filterToggle"
            class="filter-menu-items"
            aria-expanded="false"
            aria-controls="mobileFilterMenu"
        >
            SELECT CAT:
            <span id="filterCurrent" class=" bg-hypergreen">.ALL</span>
        </button>

        <nav
            id="mobileFilterMenu"
            class="absolute left-0 right-0 mt-1 border border-black bg-white hidden"
        >
            <?php foreach ( $filters as $filter ) : ?>
                <button
                    type="button"
                    class="block w-full text-left filter-menu-items"
                    data-category="<?php echo esc_attr( $filter['slug'] ); ?>">
                    <?php echo esc_html( $filter['label'] ); ?>
                </button>
            <?php endforeach; ?>
        </nav>
    </div>
<?php endif; ?>
