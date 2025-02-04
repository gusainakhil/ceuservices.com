mobiscroll.setOptions({
    theme: 'ios',
    themeVariant: 'light'
});

function getMonthDays(month) {
    var values = [];
    for (var i = 1; i <= MAX_MONTH_DAYS[month - 1]; i++) {
        values.push(i);
    }
    return values;
}

function getRecurrenceText() {
    var text;

    switch (recurrenceRepeat) {
        case 'daily':
            text = recurrenceInterval > 1 ? ('Every ' + recurrenceInterval + ' days') : 'Daily';
            break;
        case 'weekly':
            var weekDays = recurrenceWeekDays.split(',');
            var weekDaysText = weekDays.map(function (weekDay) {
                return DAY_NAMES[DAY_NAMES_MAP[weekDay]];
            }).join(', ');
            text = recurrenceInterval > 1 ? ('Every ' + recurrenceInterval + ' weeks') : 'Weekly';
            text += ' on ' + weekDaysText;
            break;
        case 'monthly':
            text = recurrenceInterval > 1 ? ('Every ' + recurrenceInterval + ' months') : 'Monthly';
            text += ' on day ' + recurrenceDay;
            break;
        case 'yearly':
            text = recurrenceInterval > 1 ? ('Every ' + recurrenceInterval + ' years') : 'Annualy';
            text += ' on ' + MONTH_NAMES[recurrenceMonth - 1] + ' ' + recurrenceDay;
            break;
    }

    switch (recurrenceCondition) {
        case 'until':
            text += ' until ' + mobiscroll.util.datetime.formatDate('MMMM D, YYYY', new Date(recurrenceUntil));
            break;
        case 'count':
            text += ', ' + recurrenceCount + ' times';
            break;
    }

    return text;
}

function getRecurrenceRule() {
    var d = new Date(eventStart);
    var weekNr = Math.ceil(d.getDate() / 7);
    var weekDay = DAY_NAMES_SHORT[d.getDay()];
    var month = d.getMonth() + 1;
    var monthDay = d.getDate();

    switch (eventRecurrence) {
        // Predefined recurring rules
        case 'daily':
            return { repeat: 'daily' };
        case 'weekly':
            return { repeat: 'weekly', weekDays: weekDay };
        case 'monthly':
            return { repeat: 'monthly', day: monthDay };
        case 'monthly-pos':
            return { repeat: 'monthly', weekDays: weekDay, pos: weekNr };
        case 'yearly':
            return { repeat: 'yearly', day: monthDay, month: month };
        case 'yearly-pos':
            return { repeat: 'yearly', weekDays: weekDay, month: month, pos: weekNr };
        case 'weekday':
            return { repeat: 'weekly', weekDays: 'MO,TU,WE,TH,FR' };
            // Custom recurring rule
        case 'custom':
        case 'custom-value':
            var rule = {
                repeat: recurrenceRepeat,
                interval: recurrenceInterval
            };
            switch (recurrenceRepeat) {
                case 'weekly':
                    rule.weekDays = recurrenceWeekDays;
                    break;
                case 'monthly':
                    rule.day = recurrenceDay;
                    break;
                case 'yearly':
                    rule.day = recurrenceDay;
                    rule.month = recurrenceMonth;
                    break;
            }
            switch (recurrenceCondition) {
                case 'until':
                    rule.until = recurrenceUntil;
                    break;
                case 'count':
                    rule.count = recurrenceCount;
                    break;
            }
            return rule;
        default:
            return null;
    }
}

function getRecurrenceTypes(date, recurrence) {
    var d = new Date(date);
    var weekDay = DAY_NAMES[d.getDay()];
    var weekNr = Math.ceil(d.getDate() / 7);
    var month = MONTH_NAMES[d.getMonth()].text;
    var monthDay = d.getDate();
    var ordinal = { 1: 'first', 2: 'second', 3: 'third', 4: 'fourth', 5: 'fifth' };
    var data = [
        { value: 'norepeat', text: 'Does not repeat' },
        { value: 'daily', text: 'Daily' },
        { value: 'weekly', text: 'Weekly on ' + weekDay },
        { value: 'monthly', text: 'Monthly on day ' + monthDay },
        { value: 'monthly-pos', text: 'Monthly on the ' + ordinal[weekNr] + ' ' + weekDay },
        { value: 'yearly', text: 'Annually on ' + month + ' ' + monthDay },
        { value: 'yearly-pos', text: 'Annually on the ' + ordinal[weekNr] + ' ' + weekDay + ' of ' + month },
        { value: 'weekday', text: 'Every weekday (Monday to Friday)' },
        { value: 'custom', text: 'Custom' }
    ];
    if (recurrence === 'custom-value') {
        data.push({ value: 'custom-value', text: getRecurrenceText() });
    }
    return data;
}

function getEventRecurrence(event) {
    var recurringRule = event.recurring;
    if (recurringRule) {
        var repeat = recurringRule.repeat;
        if (recurringRule.interval > 1 || recurringRule.count || recurringRule.until) {
            return 'custom-value';
        }
        switch (repeat) {
            case 'weekly':
                var weekDays = recurringRule.weekDays || '';
                if (weekDays === 'MO,TU,WE,TH,FR') {
                    return 'weekday';
                }
                if (weekDays.split(',').length > 1) {
                    return 'custom-value';
                }
            case 'monthly':
            case 'yearly':
                if (recurringRule.pos) {
                    return repeat + '-pos';
                }
            default:
                return repeat;
        }
    }
    return 'norepeat';
}

function toggleDatetimePicker(allDay) {
    // Toggle between date and datetime picker
    eventStartEndPicker.setOptions({
        controls: allDay ? ['date'] : ['datetime'],
        responsive: allDay ? { medium: { controls: ['calendar'], touchUi: false } } : { medium: { controls: ['calendar', 'time'], touchUi: false } }
    });
}

function toggleRecurrenceEditor(recurrence) {
    if (recurrence === 'custom') {
        eventRecurrenceEditorElm.classList.remove('md-hide-elm');
    } else {
        eventRecurrenceEditorElm.classList.add('md-hide-elm');
    }
}

function toggleRecurrenceText(repeat) {
    document.querySelectorAll('.md-recurrence-text').forEach(function (elm) {
        if (elm.classList.contains('md-recurrence-' + repeat)) {
            elm.classList.remove('md-hide-elm');
        } else {
            elm.classList.add('md-hide-elm');
        }
    });
}

function navigateToEvent(event) {
    var d = new Date(event.start);
    var year = d.getFullYear();
    var month = d.getMonth();
    var day = d.getDate();
    var recurringRule = event.recurring;
    var addMonth = 0;
    var addYear = 0;
    if (recurringRule) {
        var recurringDay = recurringRule.day;
        var recurringMonth = recurringRule.month - 1;
        switch (recurringRule.repeat) {
            case 'monthly':
                if (day > recurringDay) {
                    addMonth = recurringRule.interval || 1;
                }
                day = recurringDay;
                break;
            case 'yearly':
                if (month > recurringMonth || (month === recurringMonth - 1 && day > recurringDay)) {
                    addYear = recurringRule.interval || 1;
                }
                day = recurringDay;
                month = recurringMonth;
                break;
        }
    }
    calendar.navigate(new Date(year + addYear, month + addMonth, day, d.getHours()));
}

function updateRecurringEvent() {
    var editFromPopup = addEditPopup.isVisible();

    var updatedEvent = {
        title: eventTitle,
        description: eventDescription,
        allDay: eventAllDay,
        color: eventColor,
        start: eventStart,
        end: eventEnd,
    }

    if (recurrenceEditMode !== 'current') {
        updatedEvent.id = eventId;
        updatedEvent.recurring = getRecurrenceRule();
        updatedEvent.recurringException = eventRecurringException;
    }

    var result = mobiscroll.updateRecurringEvent(
        originalRecurringEvent,
        eventOccurrence,
        editFromPopup ? null : newEvent,
        editFromPopup ? updatedEvent : null,
        recurrenceEditMode,
    );

    if (result.newEvent) {
        calendar.addEvent(result.newEvent);
    }

    calendar.updateEvent(result.updatedEvent);
}

function deleteRecurringEvent() {
    switch (recurrenceEditMode) {
        case 'following':
            var d = new Date(eventStart);
            originalRecurringEvent.recurring.until = new Date(d.getFullYear(), d.getMonth(), d.getDate());
            calendar.updateEvent(originalRecurringEvent);
            break;
        case 'all':
            calendar.removeEvent(originalRecurringEvent);
            break;
        default:
            eventRecurringException.push(eventStart);
            originalRecurringEvent.recurringException = eventRecurringException;
            calendar.updateEvent(originalRecurringEvent);
    }
}

// Fills the popup with the event's data
function fillPopup(event) {
    // Load event properties
    eventId = event.id;
    eventTitle = event.title || '';
    eventDescription = event.description || '';
    eventAllDay = event.allDay;
    eventStart = event.start;
    eventEnd = event.end;
    eventColor = event.color;
    eventRecurringException = event.recurringException || [];
    eventRecurrence = getEventRecurrence(event);

    // Load recurrence rule properties, with default values
    var recurringRule = event.recurring || {};
    recurrenceRepeat = recurringRule.repeat || 'daily';
    recurrenceInterval = recurringRule.interval || 1;
    recurrenceCondition = recurringRule.until ? 'until' : (recurringRule.count ? 'count' : 'never');
    recurrenceMonth = recurringRule.month || 1;
    recurrenceDay = recurringRule.day || 1;
    recurrenceWeekDays = recurringRule.weekDays || 'SU';
    recurrenceCount = recurringRule.count || 10;
    recurrenceUntil = recurringRule.until;

    // Set event fields
    mobiscroll.getInst(eventTitleElm).value = eventTitle;
    mobiscroll.getInst(eventDescriptionElm).value = eventDescription;
    mobiscroll.getInst(eventAllDayElm).value = eventAllDay;
    eventStartEndPicker.setVal([eventStart, eventEnd]);
    eventRecurrenceSelect.setOptions({ data: getRecurrenceTypes(eventStart, eventRecurrence) });
    eventRecurrenceSelect.setVal(eventRecurrence);
    toggleDatetimePicker(eventAllDay);
    toggleRecurrenceEditor(eventRecurrence);

    // Set custom recurring rule field values
    recurrenceIntervalElm.value = recurrenceInterval;
    recurrenceCountElm.value = recurrenceCount;
    recurrenceMonthSelect.setVal(recurrenceMonth);
    recurrenceDaySelect.setVal(recurrenceDay);
    recurrenceMonthDaySelect.setVal(recurrenceDay);
    recurrenceUntilDatepicker.setVal(recurrenceUntil);
    mobiscroll.getInst(document.getElementById('recurrence-repeat-' + recurrenceRepeat)).checked = true;
    mobiscroll.getInst(document.getElementById('recurrence-condition-' + recurrenceCondition)).checked = true;
    recurrenceWeekDaysElms.forEach(function (elm) {
        mobiscroll.getInst(elm).checked = recurrenceWeekDays.includes(elm.value);
    });
    toggleRecurrenceText(recurrenceRepeat);
}

function createAddPopup(event, target) {
    var success = false;

    // Hide delete button inside add popup
    eventDeleteButtonElm.parentElement.classList.add('md-hide-elm');

    // Set popup header text and buttons
    addEditPopup.setOptions({
        anchor: target,
        headerText: 'New event',
        buttons: ['cancel', {
            text: 'Add',
            keyCode: 'enter',
            handler: function () {
                var newEvent = {
                    id: eventId,
                    title: eventTitle,
                    description: eventDescription,
                    allDay: eventAllDay,
                    start: eventStart,
                    end: eventEnd,
                    recurring: getRecurrenceRule(),
                };
                calendar.updateEvent(newEvent);
                navigateToEvent(newEvent);
                success = true;
                addEditPopup.close();
            },
            cssClass: 'mbsc-popup-button-primary'
        }],
        onClose: function () {
            // Remove event if popup is cancelled
            if (!success) {
                calendar.removeEvent(event);
            }
        }
    });

    fillPopup(event);
    addEditPopup.open();
}

function createEditPopup(event, target) {
    // Show delete button inside edit popup
    eventDeleteButtonElm.parentElement.classList.remove('md-hide-elm');

    editedEvent = event;
    originalRecurringEvent = event.recurring ? event.original : null;
    eventOccurrence = event;

    // Set popup header text and buttons
    addEditPopup.setOptions({
        headerText: 'Edit event',
        anchor: target,
        buttons: ['cancel', {
            text: 'Save',
            keyCode: 'enter',
            handler: function () {
                if (originalRecurringEvent) {
                    // TODO: don't allow current update if recurring rule is changed
                    createRecurrenceEditPopup(false);
                } else {
                    var updatedEvent = {
                        id: eventId,
                        title: eventTitle,
                        description: eventDescription,
                        allDay: eventAllDay,
                        start: eventStart,
                        end: eventEnd,
                        recurring: getRecurrenceRule(),
                    };
                    calendar.updateEvent(updatedEvent);
                    navigateToEvent(updatedEvent);
                    addEditPopup.close();
                }
            },
            cssClass: 'mbsc-popup-button-primary'
        }],
    });

    fillPopup(event);
    addEditPopup.open();
}

function createRecurrenceEditPopup(isDelete) {
    recurrenceEditModeTextElm.textContent = isDelete ? 'Delete' : 'Edit';
    recurrenceDelete = isDelete;
    recurrenceEditModePopup.open();
}

var MAX_MONTH_DAYS = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
var DAY_NAMES = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
var DAY_NAMES_SHORT = ['SU', 'MO', 'TU', 'WE', 'TH', 'FR', 'SA'];
var DAY_NAMES_MAP = { 'SU': 0, 'MO': 1, 'TU': 2, 'WE': 3, 'TH': 4, 'FR': 5, 'SA': 6 };
var MONTH_NAMES = [
    { value: 1, text: 'January' },
    { value: 2, text: 'February' },
    { value: 3, text: 'March' },
    { value: 4, text: 'April' },
    { value: 5, text: 'May' },
    { value: 6, text: 'June' },
    { value: 7, text: 'July' },
    { value: 8, text: 'August' },
    { value: 9, text: 'September' },
    { value: 10, text: 'October' },
    { value: 11, text: 'November' },
    { value: 12, text: 'December' },
];

var originalRecurringEvent;
var eventOccurrence;
var newEvent;
var editedEvent;

var eventId;
var eventTitle;
var eventDescription;
var eventAllDay;
var eventStart;
var eventEnd;
var eventColor;
var eventRecurrence;
var eventRecurringException;

var recurrenceRepeat;
var recurrenceInterval;
var recurrenceCondition;
var recurrenceMonth;
var recurrenceDay;
var recurrenceWeekDays;
var recurrenceCount;
var recurrenceUntil;
var recurrenceDelete;
var recurrenceEditMode = 'current';

var eventTitleElm = document.getElementById('popup-event-title');
var eventDescriptionElm = document.getElementById('popup-event-description');
var eventAllDayElm = document.getElementById('popup-event-all-day');
var eventDeleteButtonElm = document.getElementById('popup-event-delete');
var eventRecurrenceEditorElm = document.getElementById('popup-event-recurrence-editor');

var recurrenceIntervalElm = document.getElementById('recurrence-interval');
var recurrenceCountElm = document.getElementById('recurrence-count');
var recurrenceEditModeTextElm = document.getElementById('recurrence-edit-mode-text');
var recurrenceWeekDaysElms = document.querySelectorAll('.md-recurrence-weekdays');

var myEvents = [{
    id: 1,
    start: '2023-07-21T00:00',
    end: '2023-07-24T00:00',
    title: 'Alice OFF',
    allDay: true,
    color: '#67ab0d'
}, {
    id: 2,
    start: '18:00',
    end: '20:00',
    recurring: {
        repeat: 'weekly',
        weekDays: 'MO',
    },
    title: 'Football training',
    allDay: false,
    color: '#fd966a'
}, {
    id: 3,
    start: '17:00',
    end: '17:30',
    recurring: {
        repeat: 'monthly',
        day: 1,
    },
    title: 'Rent payment',
    allDay: false,
    color: '#3ea39e'
}, {
    id: 4,
    recurring: {
        repeat: 'yearly',
        day: 6,
        month: 5,
    },
    title: 'Dexter BD',
    allDay: true,
    color: '#d00f0f'
}];

// Init the event calendar
var calendar = mobiscroll.eventcalendar('#demo-add-delete-event', {
    clickToCreate: 'double',
    dragToCreate: true,
    dragToMove: true,
    dragToResize: true,
    view: {
        calendar: { labels: true }
    },
    data: myEvents,
    onEventClick: function (args) {
        createEditPopup(args.event, args.domEvent.currentTarget);
    },
    onEventUpdate: function (args) {
        var event = args.event;
        if (event.recurring) {
            originalRecurringEvent = args.oldEvent;
            eventOccurrence = args.oldEventOccurrence;
            if (args.isDelete) {
                eventRecurringException = originalRecurringEvent.recurringException || [];
                eventStart = eventOccurrence.start;
                createRecurrenceEditPopup(true);
            } else {
                createRecurrenceEditPopup(false);
            }
            return false;
        }
    },
    onEventCreate: function (args) {
        if (args.originEvent) {
            // Store created event on recurring occurrence drag
            newEvent = args.event;
            // Prevent event creation on recurring occurrence drag
            return false;
        }
    },
    onEventCreated: function (args) {
        createAddPopup(args.event, args.target);
    }
});

// Init event start/end date picker
var eventStartEndPicker = mobiscroll.datepicker('#popup-event-dates', {
    controls: ['date'],
    select: 'range',
    startInput: '#popup-event-start',
    endInput: '#popup-event-end',
    showRangeLabels: false,
    touchUi: true,
    responsive: { medium: { touchUi: false } },
    onChange: function (args) {
        var dates = args.value;
        eventStart = dates[0];
        eventEnd = dates[1];
        eventRecurrenceSelect.setOptions({ data: getRecurrenceTypes(eventStart) });
    }
});

// Init event recurrence select
var eventRecurrenceSelect = mobiscroll.select('#popup-event-recurrence', {
    data: [],
    touchUi: true,
    responsive: { small: { touchUi: false } },
    onChange: function (args) {
        eventRecurrence = args.value;
        toggleRecurrenceEditor(eventRecurrence);
    }
});

// Init recurring event month day selection for monthly recurrence
var recurrenceDaySelect = mobiscroll.select('#recurrence-day', {
    data: getMonthDays(1),
    touchUi: true,
    responsive: { small: { touchUi: false } },
    maxWidth: 80,
    onChange: function (args) {
        recurrenceDay = args.value;
    }
});

// Init recurring rule month selection for yearly recurrence
var recurrenceMonthSelect = mobiscroll.select('#recurrence-month', {
    data: MONTH_NAMES,
    touchUi: true,
    responsive: { small: { touchUi: false } },
    onChange: function (args) {
        recurrenceMonth = args.value;
        var maxDay = MAX_MONTH_DAYS[recurrenceMonth - 1];
        if (recurrenceDay > maxDay) {
            recurrenceMonthDaySelect.setVal(maxDay);
        }
        recurrenceMonthDaySelect.setOptions({ data: getMonthDays(recurrenceMonth) });
    }
});

// Init recurring event month day selection for yearly recurrence
var recurrenceMonthDaySelect = mobiscroll.select('#recurrence-month-day', {
    data: getMonthDays(1),
    touchUi: true,
    responsive: { small: { touchUi: false } },
    maxWidth: 80,
    onChange: function (args) {
        recurrenceDay = args.value;
    }
});

// Init the until datepicker
var recurrenceUntilDatepicker = mobiscroll.datepicker('#recurrence-until', {
    controls: ['calendar'],
    display: 'anchored',
    touchUi: false,
    dateFormat: 'YYYY-MM-DD',
    returnFormat: 'iso8601',
    onChange: function (args) {
        recurrenceUntil = args.value;
    },
    onOpen: function () {
        // Check the until stop condition radio
        recurrenceCondition = 'until';
        mobiscroll.getInst(document.getElementById('recurrence-condition-until')).checked = true;
    }
});

// Init popup for event create/edit
var addEditPopup = mobiscroll.popup('#demo-add-edit-popup', {
    display: 'bottom',
    contentPadding: false,
    fullScreen: true,
    scrollLock: false,
    height: 500,
    responsive: {
        medium: {
            display: 'anchored',
            width: 510,
            fullScreen: false,
            touchUi: false
        }
    },
    cssClass: 'md-recurring-event-editor-popup'
});

// Init recurring edit mode popup
var recurrenceEditModePopup = mobiscroll.popup('#demo-recurrence-edit-mode-popup', {
    display: 'bottom',
    contentPadding: false,
    buttons: ['cancel', {
        text: 'Ok',
        keyCode: 'enter',
        handler: function () {
            if (recurrenceDelete) {
                deleteRecurringEvent();
            } else {
                updateRecurringEvent();
            }
            addEditPopup.close();
            recurrenceEditModePopup.close();
        },
        cssClass: 'mbsc-popup-button-primary'
    }],
    onClose: function () {
        // Reset edit mode to current
        recurrenceEditMode = 'current';
        mobiscroll.getInst(document.getElementById('recurrence-edit-mode-current')).checked = true;
    },
    responsive: {
        medium: {
            display: 'center',
            fullScreen: false,
            touchUi: false
        }
    },
    cssClass: 'md-recurring-event-editor-popup'
});

// Attach event handlers

eventTitleElm.addEventListener('input', function (ev) {
    eventTitle = ev.target.value;
});

eventDescriptionElm.addEventListener('change', function (ev) {
    eventDescription = ev.target.value;
});

eventAllDayElm.addEventListener('change', function (ev) {
    eventAllDay = ev.target.checked;
    toggleDatetimePicker(eventAllDay);
});

eventDeleteButtonElm.addEventListener('click', function () {
    if (editedEvent.recurring) {
        createRecurrenceEditPopup(true);
    } else {
        calendar.removeEvent(editedEvent);
        addEditPopup.close();
    }
});

recurrenceWeekDaysElms.forEach(function (elm) {
    elm.addEventListener('change', function () {
        var values = [];
        recurrenceWeekDaysElms.forEach(function (ev) {
            if (ev.checked) {
                values.push(ev.value);
            }
        });
        recurrenceWeekDays = values.join(',');
    });
});

recurrenceIntervalElm.addEventListener('change', function (ev) {
    var value = +ev.target.value;
    recurrenceInterval = !value || value < 1 ? 1 : value;
    ev.target.value = recurrenceInterval;
});

recurrenceCountElm.addEventListener('change', function (ev) {
    var value = +ev.target.value;
    recurrenceCount = !value || value < 1 ? 1 : value;
    ev.target.value = recurrenceCount;
});

recurrenceCountElm.addEventListener('click', function () {
    // Check the count stop condition radio
    recurrenceCondition = 'count';
    mobiscroll.getInst(document.getElementById('recurrence-condition-count')).checked = true;
});

document.querySelectorAll('.md-recurrence-repeat').forEach(function (elm) {
    elm.addEventListener('change', function (ev) {
        recurrenceRepeat = ev.target.value;
        toggleRecurrenceText(recurrenceRepeat);
    });
});

document.querySelectorAll('.md-recurrence-edit-mode').forEach(function (elm) {
    elm.addEventListener('change', function (ev) {
        recurrenceEditMode = ev.target.value;
    });
});

document.querySelectorAll('.md-recurrence-condition').forEach(function (elm) {
    elm.addEventListener('change', function (ev) {
        recurrenceCondition = ev.target.value;
    });
});