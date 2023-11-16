// editor-setup.js
const editor = new EditorJS({
    autofocus: !0,
    holder: 'editorjs',
    placeholder: "Type text or paste a link",
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
        data: {},
});

var titleInput = document.getElementById('post-editor-title');

function saveData() {
    if (titleInput.value.trim() === '') {
        event.preventDefault();
        alert('Please enter a title before saving.');
        return false;
    }

    editor.save().then((outputData) => {
        console.log('Article data: ', outputData);
        postData('../api/save_post.php', { post_title: titleInput.value, post_content: outputData });
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
        body: JSON.stringify({
            post_title: data.post_title,
            post_content: data.post_content
        }),
    })
    .then(response => response.text()) // Expecting text response here
    .then(text => {
        window.location.href = "view_material.php?id=" + text;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

