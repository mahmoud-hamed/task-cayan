function updateGlobalTimer() {
    const currentTime = new Date();
    const elapsedMilliseconds = currentTime - globalStartTime;
    const hours = Math.floor(elapsedMilliseconds / 3600000);
    const minutes = Math.floor((elapsedMilliseconds % 3600000) / 60000);
    const seconds = Math.floor((elapsedMilliseconds % 60000) / 1000);

    document.getElementById('globalTimer').textContent = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
}

document.getElementById('startGlobalTimer').addEventListener('click', function() {
    globalStartTime = new Date();
    localStorage.setItem('globalStartTime', globalStartTime.toISOString());

    globalTimerInterval = setInterval(updateGlobalTimer, 1000);
    document.getElementById('startGlobalTimer').setAttribute('disabled', 'disabled');
    document.getElementById('stopGlobalTimer').removeAttribute('disabled');
});

document.getElementById('stopGlobalTimer').addEventListener('click', function() {
    clearInterval(globalTimerInterval);
    const endTime = new Date();
    const timeSpent = Math.floor((endTime - globalStartTime) / 1000);
    const formattedTimeSpent = formatTime(timeSpent); // Format time spent

    axios.post('{{ route("store.time") }}', {
            start_time: globalStartTime.toISOString(),
            end_time: endTime.toISOString(),
            time_spent: formattedTimeSpent // Use formatted time spent
        })
        .then(response => {
            console.log(response.data.message);
        })
        .catch(error => {
            console.error('Error storing time:', error);
        });

    localStorage.removeItem('globalStartTime');


    document.getElementById('startGlobalTimer').removeAttribute('disabled');
    document.getElementById('stopGlobalTimer').setAttribute('disabled', 'disabled');
    resetGlobalTimer();

});

function formatTime(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const remainingSeconds = seconds % 60;
    return `${pad(hours)}:${pad(minutes)}:${pad(remainingSeconds)}`;
}

function pad(num) {
    return num.toString().padStart(2, '0');
}



// Restore timer state if it was previously started
const storedStartTime = localStorage.getItem('globalStartTime');
if (storedStartTime) {
    globalStartTime = new Date(storedStartTime);
    const currentTime = new Date();
    const timeSpent = Math.floor((currentTime - globalStartTime) / 1000);

    if (isNaN(timeSpent) || timeSpent < 0) {
        // If the page was reloaded while the timer was running
        globalStartTime = currentTime;
        localStorage.setItem('globalStartTime', globalStartTime.toISOString());
        resetGlobalTimer();

    } else {
        // If the timer was running before the page reload
        globalTimerInterval = setInterval(updateGlobalTimer, 1000);
        document.getElementById('startGlobalTimer').setAttribute('disabled', 'disabled');
        document.getElementById('stopGlobalTimer').removeAttribute('disabled');
    }
}

function resetGlobalTimer() {
    clearInterval(globalTimerInterval);
    document.getElementById('globalTimer').textContent = '00:00:00';
    globalStartTime = null;
    localStorage.removeItem('globalStartTime');
    document.getElementById('startGlobalTimer').removeAttribute('disabled');
    document.getElementById('stopGlobalTimer').setAttribute('disabled', 'disabled');
}

