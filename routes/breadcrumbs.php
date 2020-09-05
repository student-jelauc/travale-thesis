<?php

use App\Entities\Accommodations\Accommodation;
use App\Entities\Accommodations\Room;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home');
});

// Accommodations
Breadcrumbs::for('accommodations', function ($trail) {
    $trail->push('Accommodations', route('accommodations'));
});

Breadcrumbs::for('accommodations.create', function ($trail) {
    $trail->parent('accommodations');
    $trail->push('Create');
});

Breadcrumbs::for('accommodations.show', function ($trail, Accommodation $accommodation) {
    $trail->parent('accommodations');
    $trail->push($accommodation->name, route('accommodations.show', $accommodation));
});

Breadcrumbs::for('accommodations.edit', function ($trail, Accommodation $accommodation) {
    $trail->parent('accommodations.show', $accommodation);
    $trail->push('Edit');
});

// Rooms
Breadcrumbs::for('rooms', function ($trail, Accommodation $accommodation, $type = null) {
    $trail->parent('accommodations.show', $accommodation);
    $trail->push('Rooms', route('rooms', $accommodation));

    if ($type) {
        $trail->push($type->name, route('rooms', $accommodation, $type));
    }
});

Breadcrumbs::for('rooms.overview', function ($trail) {
    $trail->push('Rooms');
});

Breadcrumbs::for('rooms.create', function ($trail, ?Accommodation $accommodation) {
    if ($accommodation) {
        $trail->parent('accommodations.show', $accommodation);
        $trail->push('Create Room');
    } else {
        $trail->parent('accommodations');
        $trail->push('Create');
    }
});

Breadcrumbs::for('rooms.show', function ($trail, Room $room) {
    $trail->parent('rooms', $room->accommodation, $room->roomType);
    $trail->push($room->name, route('rooms.show', $room));
});

Breadcrumbs::for('rooms.edit', function ($trail, Room $room) {
    $trail->parent('rooms.show', $room);
    $trail->push('Edit');
});

