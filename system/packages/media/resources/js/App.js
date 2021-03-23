import {useState} from "react"
import Popup from "./Popup";
import Content from "./Content";

function App({popup}) {
    const [selected, setSelected] = useState([]);
  return (
      <div style={{
          // width: '1200px',
      }}>
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
