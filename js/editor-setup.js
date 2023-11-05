// editor-setup.js
const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
        header: {
            class: Header,
            inlineToolbar: ['link']
        },
        list: {
            class: List,
            inlineToolbar: true
        },
        embed: Embed,
        },
        data: {
            blocks: [
                {
                    type: "header",
                    data: {
                        text: "Title",
                        level: 1
                    }
                },
            ]
        },
});

function saveData() {
    editor.save().then((outputData) => {
        console.log('Article data: ', outputData);
        postData('save_post.php', outputData);
    }).catch((error) => {
        console.error('Saving failed: ', error);
    });
}

document.getElementById('saveButton').addEventListener('click', saveData);

function postData(url, data) {
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.text()) // Expecting text response here
    .then(text => {
        alert('Post saved: ' + text);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

