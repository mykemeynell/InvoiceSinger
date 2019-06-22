@php $status = $item->getStatus(); @endphp

@switch(strtolower($status))
    @case("draft")
    <span class="badge grey lighten-3">{{ ucwords($status) }}</span>
        @break

    @case("sent")
    <span class="badge blue lighten-1 white-text">{{ ucwords($status) }}</span>
        @break

    @case("viewed")
    <span class="badge yellow darken-2 white-text">{{ ucwords($status) }}</span>
        @break

    @case("paid")
    @case("approved")
    <span class="badge green lighten-1 white-text">{{ ucwords($status) }}</span>
        @break

    @case("overdue")
    @case("rejected")
    <span class="badge red darken-3 white-text">{{ ucwords($status) }}</span>
        @break

    @case("cancelled")
    @case("voided")
    <span class="badge grey darken-3 white-text">{{ ucwords($status) }}</span>
        @break


@endswitch
