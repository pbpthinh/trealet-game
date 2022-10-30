import './index.scss';

export default function button (props) {
  const time = 300 // ms
  const delayOnClick = 200 // ms
  const animateButton = function(e) {
    e.preventDefault;
    //reset animation
    e.target.classList.remove('animate');
    
    e.target.classList.add('animate');
    setTimeout(function(){
      e.target.classList.remove('animate');
    },time);
    if (props.onClick) {
      setTimeout(() => {
        props.onClick()
      }, delayOnClick)
    }
  };

  return (
    <button className={`bubbly-button ${props.className}`} onClick={animateButton}>
      {props.children}
    </button>
  )
}