// Simple GPS Location Handler
window.getGPSCoordinates = function() {
    if (!navigator.geolocation) {
        showGPSStatus('❌ خطا', 'مرورگر شما از GPS پشتیبانی نمی‌کند');
        return;
    }

    const buttons = document.querySelectorAll('[onclick="window.getGPSCoordinates()"]');
    let btn = buttons[buttons.length - 1]; // Get last clicked button

    if (!btn) {
        showGPSStatus('❌ خطا', 'دکمه پیدا نشد');
        return;
    }

    const originalHTML = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span>⏳ در حال دریافت موقعیت...</span>';

    navigator.geolocation.getCurrentPosition(
        function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // Find latitude input
            const latInputs = document.querySelectorAll('input[placeholder*="35.6892"], input[placeholder="35.6892"]');
            if (latInputs.length > 0) {
                latInputs[0].value = lat.toFixed(7);
                latInputs[0].dispatchEvent(new Event('input', { bubbles: true }));
                latInputs[0].dispatchEvent(new Event('change', { bubbles: true }));
                latInputs[0].dispatchEvent(new Event('blur', { bubbles: true }));
            }

            // Find longitude input
            const lngInputs = document.querySelectorAll('input[placeholder*="51.3890"], input[placeholder="51.3890"]');
            if (lngInputs.length > 0) {
                lngInputs[0].value = lng.toFixed(7);
                lngInputs[0].dispatchEvent(new Event('input', { bubbles: true }));
                lngInputs[0].dispatchEvent(new Event('change', { bubbles: true }));
                lngInputs[0].dispatchEvent(new Event('blur', { bubbles: true }));
            }

            btn.disabled = false;
            btn.innerHTML = originalHTML;
            showGPSStatus('✓ موفقیت', `موقعیت فعلی دریافت شد:\n\nعرض (Latitude): ${lat.toFixed(7)}\nطول (Longitude): ${lng.toFixed(7)}`);
        },
        function(error) {
            let message = '';
            let title = '';
            if (error.code === error.PERMISSION_DENIED) {
                title = '🔒 رد دسترسی';
                message = 'شما اجازه دسترسی به GPS را نداده‌اید.\n\nلطفا در تنظیمات مرورگر، دسترسی به موقعیت را برای این سایت فعال کنید.';
            } else if (error.code === error.POSITION_UNAVAILABLE) {
                title = '📡 موقعیت غیرقابل دسترسی';
                message = 'موقعیت جغرافیایی در دسترس نیست.\n\nدستگاه شما GPS فعال ندارد یا سیگنال ضعیف است.\n\nلطفا تلاش دوباره کنید.';
            } else if (error.code === error.TIMEOUT) {
                title = '⏱️ انتظار پایان یافت';
                message = 'زمان درخواست موقعیت به اتمام رسید.\n\nلطفا تلاش دوباره کنید.';
            } else {
                title = '❌ خطای نامشخص';
                message = `خطا: ${error.message}`;
            }

            btn.disabled = false;
            btn.innerHTML = originalHTML;
            showGPSStatus(title, message);
        }
    );
};

// Show GPS status in a div (in-page notification)
function showGPSStatus(title, message) {
    // Try to show as modal first
    const html = `<div style="padding: 20px; font-family: Arial, sans-serif; line-height: 1.8; text-align: right; direction: rtl;">
        <h3 style="margin-top: 0; color: #1f2937;">${title}</h3>
        <p style="color: #4b5563; white-space: pre-wrap;">${message}</p>
    </div>`;
    
    // Show notification in browser
    if (Notification && Notification.permission === 'granted') {
        new Notification(title, { body: message });
    } else {
        // Fall back to alert
        alert(`${title}\n\n${message}`);
    }
}

