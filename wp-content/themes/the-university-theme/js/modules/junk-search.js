/**
 * This is an OLD code to get data from /wp-json/wp/v2/posts?search=  and /wp-json/wp/v2/pages?search=
 * It was substituted by a new one using the new URL Json that I create.
 *
 * ************************************ THIS CODE NO LONGER IS IN USE! JUST REFERENCES *****************************************
 * *****************************************************************************************************************************
 * ************************************ THIS CODE NO LONGER IS IN USE! JUST REFERENCES *****************************************
 */

getResults = () => {
  $.when(
    $.getJSON(
      universityData.root_url +
        "/wp-json/wp/v2/posts?search=" +
        this.searchField.val()
    ),
    $.getJSON(
      universityData.root_url +
        "/wp-json/wp/v2/pages?search=" +
        this.searchField.val()
    )
  ).then(
    (posts, pages) => {
      var combineResults = posts[0].concat(pages[0]);
      this.resultsDiv.html(`
                <h2 class="search-overlay__section-title">General Information</h2>
                ${
                  combineResults.length
                    ? `<ul class="link-list min-list">`
                    : `<p>No general information matches that search..</p>`
                }
                    ${combineResults
                      .map(
                        (item) =>
                          `<li><a href="${item.link}">${
                            item.title.rendered
                          }</a><small>${
                            item.type == "post" ? " by " + item.authorName : ""
                          }</small></li>`
                      )
                      .join("")}
                ${combineResults.length ? `</ul>` : ""}
            `);
      this.isSpinnerVisible = false;
    },
    // For error returns
    () => {
      this.resultsDiv.html("<p>Unexpected Error; please try again..</p>");
    }
  );
};

/**
 * ********************************************************************************************************************************************
 * ********************************************** SEARCH CODE WITH JQUERY LIBRARY *************************************************************
 * ********************************************************************************************************************************************
 */

import $ from "jquery";

class Search {
  constructor() {
    this.addSearchHtml();
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.resultsDiv = $("#search-overlay__results");
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
  }

  //Events
  events = () => {
    this.openButton.on("click", this.openOverlay);
    this.closeButton.on("click", this.closeOverlay);
    $(document).on("keydown", this.keyPressDispacher);
    this.searchField.on("keyup", this.typingLogic);
  };

  //methods
  openOverlay = () => {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchField.val("");
    setTimeout(() => this.searchField.trigger("focus"), 301);
    this.isOverlayOpen = true;
  };

  closeOverlay = () => {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
  };

  typingLogic = () => {
    //console.log(e.target.value);
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults, 750);
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchField.val();
  };

  //Request from wordpress the data
  getResults = () => {
    $.getJSON(
      universityData.root_url +
        "/wp-json/university/v1/search?term=" +
        this.searchField.val(),
      (results) => {
        this.resultsDiv.html(`
          <div class="row">
           <div class="one-third">
             <h2 class="search-overlay__section-title">General Information</h2>
             ${
               results.generalInfo.length
                 ? `<ul class="link-list min-list">`
                 : `<p>No general information matches that search..</p>`
             }
             ${results.generalInfo
               .map(
                 (item) =>
                   `<li><a href="${item.permalink}">${item.title}</a><small>${
                     item.postType == "post" ? " by " + item.authorName : ""
                   }</small></li>`
               )
               .join("")}
             ${results.generalInfo.length ? `</ul>` : ""}
           </div>
           
           <div class="one-third">
             <h2 class="search-overlay__section-title">Programs</h2>
             ${
               results.programs.length
                 ? `<ul class="link-list min-list">`
                 : `<p>No programs matche that search. <a href="${universityData.root_url}/programs">View all programs</a></p>`
             }
             ${results.programs
               .map(
                 (item) =>
                   `<li><a href="${item.permalink}">${item.title}</a></li>`
               )
               .join("")}              
             ${results.programs.length ? `</ul>` : ""}
 
             <h2 class="search-overlay__section-title">Professors</h2>
             ${
               results.professors.length
                 ? `<ul class="professor-cards">`
                 : `<p>No professors matche that search.</p>`
             }
             ${results.professors
               .map(
                 (item) =>
                   `
                   <li class="professor-card__list-item"><a class="professor-card" href="${item.permalink}">
                     <img src="${item.image}" class="professor-card__image">
                     <span class="professor-card__name">${item.title}</span>
                   </a></li>
                   `
               )
               .join("")}              
             ${results.professors.length ? `</ul>` : ""}
 
           </div>
 
           <div class="one-third">
             <h2 class="search-overlay__section-title">Campuses</h2>
             ${
               results.campuses.length
                 ? `<ul class="link-list min-list">`
                 : `<p>No campuses matche that search. <a href="${universityData.root_url}/campuses">View all campuses</a></p>`
             }
             ${results.campuses
               .map(
                 (item) =>
                   `<li><a href="${item.permalink}">${item.title}</a></li>`
               )
               .join("")}              
             ${results.campuses.length ? `</ul>` : ""}
             
             <h2 class="search-overlay__section-title">Events</h2>
             ${
               results.events.length
                 ? ``
                 : `<p>No events matche that search. <a href="${universityData.root_url}/events">View all events</a></p>`
             }
             ${results.events
               .map(
                 (item) =>
                   `
                   <div class="event-summary">
                       <a class="event-summary__date t-center" href="${item.permalink}">
                       <span class="event-summary__month">${item.month}</span>
                       <span class="event-summary__day">${item.day}</span>
                       </a>
                       <div class="event-summary__content">
                       <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                       <p>${item.description}<a href="${item.permalink}"> readmore</a></p>
                       </div>
                   </div>
                   `
               )
               .join("")}
 
           </div>
         
         </div>
       `);
        this.isSpinnerVisible = false;
      }
    );
  };

  keyPressDispacher = (e) => {
    //e.keyCode to show the number of any key i press in the board..
    console.log(e.keyCode);
    if (
      e.keyCode == 83 &&
      !this.isOverlayOpen &&
      $("input, textarea").is(":focus")
    ) {
      this.openOverlay();
      console.log("Open");
    }
    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
      console.log("Close");
    }
  };

  //Creating the search overlay html
  addSearchHtml = () => {
    $("body").append(`
      <div class="search-overlay">
          <div class="search-overlay__top">
              <div class="container">
                  <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                  <input type="text" id="search-term" class="search-term" placeholder="What are you looking for?" autocomplete="off">
                  <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
              </div>
          </div>
          <div class="container">
              <div id="search-overlay__results">
                  
              </div>
          </div>
      </div>
    `);
  };
}

export default Search;
