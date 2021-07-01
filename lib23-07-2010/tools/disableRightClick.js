//Javascript

/**This function when used as onmouseover event listener disables the
 *function of the right mouse button.
 */
function disableRight()
{var evt = arguments.length ? arguments[0] : window.event;
 var n;
 if(typeof(evt.which) == "number")
  n = evt.which;
 else if(typeof(evt.button) == "number")
  n = evt.button;
 else if(typeof(evt.button) == "string")
  {if (evt.button == "middle")
    n = 2;
   else if (evt.button == "right")
    n = 3;
   else n = 1;
  }
 else n = 1;
 if(n >=2)
  {
   alert("Accion deshabilitada!" );
   return false;
  }
 else
  return true;
}

/**Place this function in the body of the onload event processor.
 *A message that is displayed when the user tries to use the right button
 *may be passed as function parameter.
 */
function initDisableRight()
{if(arguments.length)
  message  = arguments[0];
 document.onmousedown = disableRight;
 if(document.captureEvents)
  document.captureEvents(Event.MOUSEDOWN);
}
