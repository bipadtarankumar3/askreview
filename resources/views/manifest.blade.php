{
    "name": "Askreview Qr code",
    "short_name": "Askreview",
    "start_url": "{{ url('/u/' . $userId) }}", // Use the dynamic start URL
    "background_color": "#6777ef",
    "description": "Askreview Qr code",
    "display": "fullscreen",
    "theme_color": "#6777ef",
    "icons": [
        {
            "src": "{{ url('lo.jpg') }}",
            "sizes": "512x512",
            "type": "image/png",
            "purpose": "any maskable"
        }
    ]
}
