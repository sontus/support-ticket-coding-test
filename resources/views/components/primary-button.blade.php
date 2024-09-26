<button {{ $attributes->merge(['type' => 'submit', 'class' => 'mt-3 btn btn-primary']) }}>
    {{ $slot }}
</button>
