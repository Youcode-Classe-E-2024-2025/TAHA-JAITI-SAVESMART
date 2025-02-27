const handleMessage = () => {
    const message = document.querySelector('#messageDisplay');

    if (message) {
        setTimeout(() => {
            message.remove();
        }, 3000);
    }
}

export default handleMessage;
