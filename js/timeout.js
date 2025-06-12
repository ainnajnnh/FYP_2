setTimeout(function() {
    alert('Session expired due to inactivity!');
    window.location.href = '../logout.php?auto=true';
}, 1800000); // 30 minutes