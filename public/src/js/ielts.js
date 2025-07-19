function mark(btn) {
  const input = btn.previousElementSibling;
  input.classList.toggle('marked');
}

document.addEventListener('contextmenu', function (e) {
  if (e.target.tagName === 'INPUT') {
    e.preventDefault();
    const input = e.target;
    const choice = prompt("Type 'note' to add a comment or 'highlight' to highlight:");
    if (choice === 'note') {
      const note = prompt('Enter your note:');
      if (note) {
        let noteEl = input.nextElementSibling;
        if (!noteEl || !noteEl.classList.contains('note')) {
          noteEl = document.createElement('div');
          noteEl.className = 'note';
          input.insertAdjacentElement('afterend', noteEl);
        }
        noteEl.textContent = note;
      }
    } else if (choice === 'highlight') {
      input.classList.toggle('highlighted');
    }
  }
});
// Optional: Automatically update current page number (if multi-part)
function updatePageLabel(index, total) {
  const label = document.getElementById('pageLabel');
  if (label) {
    label.textContent = `Part ${index + 1} of ${total}`;
  }
}
