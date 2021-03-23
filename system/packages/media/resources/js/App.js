import {useState, useEffect} from "react"
import Popup from "./Popup";
import Content from "./Content";

function App({popup}) {
    const [selected, setSelected] = useState([]);

    useEffect(() => {
        return () => {
            console.log('dis mount')
        }
    }, [])
  return (
      <div id="tnmedia">
          {
              popup ? (
                  <Popup selected={selected}>
                      <Content onChange={setSelected} popup/>
                  </Popup>
              ) : (
                  <Content/>
              )
          }
      </div>
  );
}

export default App;
