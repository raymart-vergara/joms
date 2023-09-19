<script type="text/javascript">
// Notification Global Variables for Realtime
var realtime_load_notif_ame3;
var realtime_load_notif_ame3_joms_request_page;

const load_notif_ame3 = () => {
  $.ajax({
    url: '../../process/purchasing/notification.php',
    type: 'POST',
    cache: false,
    data: {
      method: 'count_notif_ame3'
    }, 
    beforeSend: (jqXHR, settings) => {
      jqXHR.url = settings.url;
      jqXHR.type = settings.type;
    }, 
    success: response => {
      var icon = `<i class="far fa-bell"></i>`;
      var badge = "";
      var notif_badge = "";
      var notif_new_joms_request = "";
      var notif_new_joms_request_val = sessionStorage.getItem('notif_new_joms_request');
      var notif_new_joms_request_body = "";
      try {
        let response_array = JSON.parse(response);
        if (response_array.total > 0) {
          if (response_array.total > 99) {
            var badge = `<span class="badge badge-danger navbar-badge">99+</span>`;
          } else {
            var badge = `<span class="badge badge-danger navbar-badge">${response_array.total}</span>`;
          }
          var notif_badge = `${icon}${badge}`;
          if (response_array.new_joms_request > 0) {
            if (response_array.new_joms_request < 2) {
              var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> ${response_array.new_joms_request} new request <span class="float-right text-muted text-sm"></span>`;
              var notif_new_joms_request_body = `${response_array.new_joms_request} new request `;
            } else {
              var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> ${response_array.new_joms_request} new requests <span class="float-right text-muted text-sm"></span>`;
              var notif_new_joms_request_body = `${response_array.new_joms_request} new requests `;
            }
          } else {
            var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> No new requests <span class="float-right text-muted text-sm"></span>`;
          }
          if (notif_new_joms_request_val != response_array.new_joms_request) {
            $(document).Toasts('create', {
              class: 'bg-warning',
              body: notif_new_joms_request_body,
              title: 'New requests',
              icon: 'fas fa-exclamation-circle fa-lg',
              autohide: true,
              delay: 4800
            });
          }
          sessionStorage.setItem('notif_new_joms_request', response_array.new_joms_request);
        } else {
          sessionStorage.setItem('notif_new_joms_request', 0);
          var notif_badge = `${icon}`;
          var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> No new requests <span class="float-right text-muted text-sm"></span>`;
        }
      } catch(e) {
        console.log(response);
        console.log(`Notification Error!!! Call IT Personnel Immediately!!! They will fix it right away. Error: ${response}`);
      }
      $('#notif_badge').html(notif_badge);
      $('#notif_new_joms_request').html(notif_new_joms_request);
    }
  })
  .fail((jqXHR, textStatus, errorThrown) => {
    console.log(jqXHR);
    if (textStatus == "timeout") {
      console.log(`Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( Connection / Request Timeout )`);
      clearInterval(realtime_load_notif_ame3);
      setTimeout(() => {window.location.reload()}, 5000);
    } else {
      console.log(`System Error!!! Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} )`);
    }
  });
}

const load_notif_ame3_joms_request_page = () => {
  $.ajax({
    url: '../../process/purchasing/notification.php',
    type: 'POST',
    cache: false,
    data: {
      method: 'count_notif_ame3'
    }, 
    beforeSend: (jqXHR, settings) => {
      jqXHR.url = settings.url;
      jqXHR.type = settings.type;
    }, 
    success: response => {
      var icon = `<i class="far fa-bell"></i>`;
      var badge = "";
      var notif_badge = "";
      var notif_new_joms_request = "";
      var notif_new_joms_request_val = sessionStorage.getItem('notif_new_joms_request');
      var notif_new_joms_request_body = "";
      try {
        let response_array = JSON.parse(response);
        if (response_array.total > 0) {
          if (response_array.total > 99) {
            var badge = `<span class="badge badge-danger navbar-badge">99+</span>`;
          } else {
            var badge = `<span class="badge badge-danger navbar-badge">${response_array.total}</span>`;
          }
          var notif_badge = `${icon}${badge}`;
          if (response_array.new_joms_request > 0) {
            if (response_array.new_joms_request < 2) {
              var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> ${response_array.new_joms_request} new request <span class="float-right text-muted text-sm"></span>`;
              var notif_new_joms_request_body = `${response_array.new_joms_request} new request `;
            } else {
              var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> ${response_array.new_joms_request} new requests <span class="float-right text-muted text-sm"></span>`;
              var notif_new_joms_request_body = `${response_array.new_joms_request} new requests `;
            }
          } else {
            var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> No new requests <span class="float-right text-muted text-sm"></span>`;
          }
          if (notif_new_joms_request_val != response_array.new_joms_request) {
            if (notif_new_joms_request_val < response_array.new_joms_request) {
              $(document).Toasts('create', {
                class: 'bg-warning',
                body: notif_new_joms_request_body,
                title: 'New requests',
                icon: 'fas fa-exclamation-circle fa-lg',
                autohide: true,
                delay: 4800
              });
              update_notif_new_joms_request(); // AUTOCLEAR NOTIF
            }
          }
          sessionStorage.setItem('notif_new_joms_request', response_array.new_joms_request);
        } else {
          sessionStorage.setItem('notif_new_joms_request', 0);
          var notif_badge = `${icon}`;
          var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> No new requests <span class="float-right text-muted text-sm"></span>`;
        }
      } catch(e) {
        console.log(response);
        console.log(`Notification Error!!! Call IT Personnel Immediately!!! They will fix it right away. Error: ${response}`);
      }
      $('#notif_badge').html(notif_badge);
      $('#notif_new_joms_request').html(notif_new_joms_request);
    }
  })
  .fail((jqXHR, textStatus, errorThrown) => {
    console.log(jqXHR);
    if (textStatus == "timeout") {
      console.log(`Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( Connection / Request Timeout )`);
      clearInterval(realtime_load_notif_ame3_joms_request_page);
      setTimeout(() => {window.location.reload()}, 5000);
    } else {
      console.log(`System Error!!! Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} )`);
    }
  });
}

const update_notif_ame3_badge = () => {
  $.ajax({
    url: '../../process/purchasing/notification.php',
    type: 'POST',
    cache: false,
    data: {
      method: 'count_notif_ame3'
    }, 
    beforeSend: (jqXHR, settings) => {
      jqXHR.url = settings.url;
      jqXHR.type = settings.type;
    }, 
    success: response => {
      var icon = `<i class="far fa-bell"></i>`;
      var badge = "";
      var notif_badge = "";
      var notif_new_joms_request = "";
      var notif_new_joms_request_val = sessionStorage.getItem('notif_new_joms_request');
      try {
        let response_array = JSON.parse(response);
        if (response_array.total > 0) {
          if (response_array.total > 99) {
            var badge = `<span class="badge badge-danger navbar-badge">99+</span>`;
          } else {
            var badge = `<span class="badge badge-danger navbar-badge">${response_array.total}</span>`;
          }
          var notif_badge = `${icon}${badge}`;
          if (response_array.new_joms_request > 0) {
            if (response_array.new_joms_request < 2) {
              var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> ${response_array.new_joms_request} new request <span class="float-right text-muted text-sm"></span>`;
            } else {
              var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> ${response_array.new_joms_request} new requests <span class="float-right text-muted text-sm"></span>`;
            }
          } else {
            var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> No new requests <span class="float-right text-muted text-sm"></span>`;
          }
          sessionStorage.setItem('notif_new_joms_request', response_array.new_joms_request);
        } else {
          sessionStorage.setItem('notif_new_joms_request', 0);
          var notif_badge = `${icon}`;
          var notif_new_joms_request = `<i class="fas fa-exclamation-circle mr-2"></i> No new requests <span class="float-right text-muted text-sm"></span>`;
        }
      } catch(e) {
        console.log(response);
        console.log(`Notification Error!!! Call IT Personnel Immediately!!! They will fix it right away. Error: ${response}`);
      }
      $('#notif_badge').html(notif_badge);
      $('#notif_new_joms_request').html(notif_new_joms_request);
    }
  })
  .fail((jqXHR, textStatus, errorThrown) => {
    console.log(jqXHR);
    console.log(`System Error!!! Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} )`);
  });
}

// Notifications
const update_notif_new_joms_request = () => {
  $.ajax({
    url: '../../process/purchasing/notification.php',
    type: 'POST',
    cache: false,
    data: {
      method: 'update_notif_new_joms_request'
    }, 
    beforeSend: (jqXHR, settings) => {
      jqXHR.url = settings.url;
      jqXHR.type = settings.type;
    }, 
    success: response => {
      if (response != '') {
        console.log(response);
        console.log(`Notification Error!!! Call IT Personnel Immediately!!! They will fix it right away. Error: ${response}`);
      } else {
        update_notif_ame3_badge();
      }
    }
  })
  .fail((jqXHR, textStatus, errorThrown) => {
    console.log(jqXHR);
    console.log(`System Error!!! Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} )`);
  });
}
</script>