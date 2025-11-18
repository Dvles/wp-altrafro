<?php

add_action( 'init', function () {
    // Intro
    register_block_style(
        'core/paragraph',
        [
            'name'  => 'intro',
            'label' => __( 'Intro', 'altr' ),
        ]
    );

    // Outro
    register_block_style(
        'core/paragraph',
        [
            'name'  => 'outro',
            'label' => __( 'Outro', 'altr' ),
        ]
    );
});
