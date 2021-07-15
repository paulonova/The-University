import $ from "jquery";

class MyNotes {
  constructor() {
    this.events();
  }

  /**
   * This way I can create notes in real time and activate the
   * Edit, Cancel and Delete button in real time.
   * $(".delete-note").on("click", this.deleteNote); will need to reload the page
   * in order to be active..
   */
  events = () => {
    $("#my-notes").on("click", ".delete-note", this.deleteNote);
    $("#my-notes").on("click", ".edit-note", this.editNote);
    $("#my-notes").on("click", ".update-note", this.updateNote);
    $(".submit-note").on("click", this.createNote);
  };

  // 'status': 'publish' make the note not a draft, but published..
  createNote = (e) => {
    var ourNewPost = {
      title: $(".new-note-title").val(),
      content: $(".new-note-body").val(),
      status: "publish",
    };

    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", universityData.nonce); //nonce is in functions.php
      },
      url: universityData.root_url + "/wp-json/wp/v2/note/",
      type: "POST",
      data: ourNewPost,
      success: (response) => {
        $(".new-note-title, .new-note-body").val("");
        $(`
          <li data-id="${response.id}"> <!-- Makes the ID lives in html -->
            <a href="${response.link}"><input readonly class="note-title-field" value="${response.title.raw}"></a>
            <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
            <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
            <textarea readonly class="note-body-field">${response.content.raw}</textarea>
            <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i> Save</span>
          </li>
          `)
          .prependTo("#my-notes")
          .hide()
          .slideDown();
        console.log("Note Created..");
        console.log(response);
      },
      error: (response) => {
        if (
          response.responseText.trim() == "You have reached your note limit."
        ) {
          $(".note-limit-message").addClass("active");
        }
        console.log("Sorry");
        console.log(response);
        console.log("ERROR: " + response.responseText.trim());
      },
    });
  };

  editNote = (e) => {
    var thisNote = $(e.target).parents("li");

    if (thisNote.data("state") == "editable") {
      this.makeNoteReadOnly(thisNote);
    } else {
      this.makeNoteEditable(thisNote);
    }
  };

  makeNoteEditable = (thisNote) => {
    thisNote
      .find(".edit-note")
      .html('<i class="fa fa-times" aria-hidden="true"></i>Cancel');
    thisNote
      .find(".note-title-field, .note-body-field")
      .removeAttr("readonly")
      .addClass("note-active-field");
    thisNote.find(".update-note").addClass("update-note--visible");
    thisNote.data("state", "editable");
  };

  makeNoteReadOnly = (thisNote) => {
    thisNote
      .find(".edit-note")
      .html('<i class="fa fa-pencil" aria-hidden="true"></i>Edit');
    thisNote
      .find(".note-title-field, .note-body-field")
      .attr("readonly", "readonly")
      .removeClass("note-active-field");
    thisNote.find(".update-note").removeClass("update-note--visible");
    thisNote.data("state", "cancel");
  };

  updateNote = (e) => {
    var thisNote = $(e.target).parents("li");
    var ourUpdatedPost = {
      title: thisNote.find(".note-title-field").val(),
      content: thisNote.find(".note-body-field").val(),
    };

    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", universityData.nonce);
      },

      url:
        universityData.root_url + "/wp-json/wp/v2/note/" + thisNote.data("id"),
      type: "POST",
      data: ourUpdatedPost,

      success: (response) => {
        this.makeNoteReadOnly(thisNote);
        console.log("Congrats");
        console.log(response);
      },
      error: (error) => {
        console.log("ERROR!");
        console.log(error);
      },
    });
  };

  deleteNote = (e) => {
    var thisNote = $(e.target).parents("li");

    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", universityData.nonce);
      },

      url:
        universityData.root_url + "/wp-json/wp/v2/note/" + thisNote.data("id"),
      type: "DELETE",

      success: (response) => {
        thisNote.slideUp();
        console.log("Congrats");
        console.log(response);
      },
      error: (error) => {
        console.log("ERROR!");
        console.log(error);
      },
    });
  };
}

export default MyNotes;
