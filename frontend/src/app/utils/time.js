export function time(timestamp) {
  const date = new Date(timestamp * 1000);
  const hours = date.getHours();
  const minutes = date.getMinutes();
  let h = `${hours}`;
  if (hours < 10) h = `0${h}`;
  let m = `${minutes}`;
  if (minutes < 10) m = `0${m}`;
  return `${h}:${m}`;
}

export function timeLeft(totalSeconds, shorten) {
  
  const hours = Math.floor(totalSeconds / 3600);
  const minutes = Math.floor(totalSeconds / 60) % 60;
  const seconds = Math.floor(totalSeconds % 60);
  let h = `${hours}`;
  let m = `${minutes}`;
  let s = `${seconds}`;
  if (hours < 10) h = `0${h}`;
  if (minutes < 10) m = `0${m}`;
  if (seconds < 10) s = `0${s}`;

  if(hours && shorten){
    let hr = hours == 1 ? `${hours} hr.`:`${hours} hrs.`;
    let mins = minutes == 1 ? `${minutes} min.`:`${minutes} mins.`;
    return `${hr} ${mins}`;
  }

  if(shorten && minutes == 1) return `${minutes} min.`;
  if(shorten) return `${minutes} mins.`;
  return `${m}:${s}`;
}

