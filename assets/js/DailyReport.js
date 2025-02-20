
$(document).ready(function() {
    let mediaRecorder;
    let audioChunks = [];
    let isRecording = false;
    let audioBlob = null;

    function resetButtons() {
        $("#startRecord").prop("disabled", false).show();
        $("#pauseRecord, #stopRecord").hide();
    }

    $("#startRecord").click(async function() {
        let stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        mediaRecorder = new MediaRecorder(stream);
        audioChunks = [];

        mediaRecorder.ondataavailable = (event) => {
            audioChunks.push(event.data);
        };

        mediaRecorder.onstop = () => {
            audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
            const audioUrl = URL.createObjectURL(audioBlob);
            $("#audioPlayback").attr("src", audioUrl).removeClass("hidden");

            // Convert blob to file
            const audioFile = new File([audioBlob], "recording_" + Date.now() + ".wav", { type: "audio/wav" });
            let fileInput = document.getElementById("voiceFileInput");
            let dataTransfer = new DataTransfer();
            dataTransfer.items.add(audioFile);
            fileInput.files = dataTransfer.files;
        };

        mediaRecorder.start();
        isRecording = true;

        $("#pauseRecord, #stopRecord").show();
        $("#startRecord").prop("disabled", true);
    });

    $("#pauseRecord").click(function() {
        if (mediaRecorder.state === "recording") {
            mediaRecorder.pause();
            $(this).text("Resume");

            // Create partial audio playback from current data
            let partialBlob = new Blob(audioChunks, { type: 'audio/wav' });
            const partialUrl = URL.createObjectURL(partialBlob);
            $("#audioPlayback").attr("src", partialUrl).removeClass("hidden");
        } else {
            mediaRecorder.resume();
            $(this).text("Pause");
        }
    });

    $("#stopRecord").click(function() {
        if (isRecording) {
            mediaRecorder.stop();
            isRecording = false;
            resetButtons();
        }
    });

    resetButtons();
});

