
<?php
$filters = $args['filters'] ?? [];
$variant = $args['variant'] ?? 'desktop';
?>

<?php if ( $variant === 'desktop' ) : ?>
    <nav class="filter-menu hidden md:flex">
        <?php foreach ( $filters as $filter ) : ?>
            <button
                type="button"
                class="filter-menu-items"
                data-category="<?php echo esc_attr( $filter['slug'] ); ?>">
                <?php echo esc_html( $filter['label'] ); ?>
            </button>
        <?php endforeach; ?>
    </nav>
<?php else : ?>
    <!-- MOBILE DROPDOWN -->
    <div class="md:hidden relative">
<button
    id="filterToggle"
    type="button"
    class="filter-menu-toggle bg-hypergreen flex items-center gap-2"
    aria-expanded="false"
    aria-controls="mobileFilterMenu"
>
    <span class="block">SELECT CAT:</span>
    <span id="filterCurrent" class="block relative z-50 pl-4 ">.ALL</span>
</button>

        <!-- Backdrop just for the filter -->
        <div
            id="filter-backdrop"
            class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 hidden z-30"
        ></div>

        <nav
            id="mobileFilterMenu"
            class="absolute left-0 mt-1 border border-black bg-white hidden z-40"
        >
            <?php foreach ($filters as $filter) : ?>
                <button
                    type="button"
                    class="block w-full left-6 text-left filter-menu-option px-4 py-2 border-b border-black last:border-b-0"
                    data-category="<?php echo esc_attr($filter['slug']); ?>">
                    <?php echo esc_html($filter['label']); ?>
                </button>
            <?php endforeach; ?>
        </nav>
    </div>
<?php endif; ?>
