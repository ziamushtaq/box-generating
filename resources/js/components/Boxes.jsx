// resources/js/components/Boxes.jsx
import React, { useEffect, useState } from "react";
import axios from "axios";

const baseColors = ["red","yellow","green","blue","pink","grey"];

export default function Boxes() {
  const [colors, setColors] = useState([...baseColors]);
  const [boxes, setBoxes] = useState([]);

  const fetchBoxes = async () => {
    const res = await axios.get("/api/boxes");
    setBoxes(res.data);
  };

  useEffect(() => {
    fetchBoxes();
    const interval = setInterval(fetchBoxes, 10000);
    return () => clearInterval(interval);
  }, []);

  const shuffleColors = () => {
    let shuffled = [...colors];
    for (let i = shuffled.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
    }
    setColors(shuffled);
  };

  const sortedBoxes = [...boxes].sort(
    (a, b) => colors.indexOf(a.color) - colors.indexOf(b.color)
  );

  return (
    <div style={{textAlign:"center",padding:"20px"}}>
      <h2>Colors: {colors.join(", ")}</h2>
      <button onClick={shuffleColors}>Shuffle Colours</button>
      <button onClick={fetchBoxes} style={{marginLeft:"10px"}}>Refresh</button>
      <div style={{display:"flex",flexWrap:"wrap",marginTop:"20px",justifyContent:"center"}}>
        {sortedBoxes.map((box) => (
          <div key={box.id} style={{
            height: box.height+"px",
            width: box.width+"px",
            background: box.color,
            margin:"5px"
          }}/>
        ))}
      </div>
    </div>
  );
}
