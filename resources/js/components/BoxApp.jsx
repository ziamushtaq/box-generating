import React, { useEffect, useState } from "react";
import axios from "axios";
import { getBoxes } from "../Api/BoxApi";

export default function BoxApp() {
  const [boxes, setBoxes] = useState([]);
  const [colors, setColors] = useState(["red", "yellow", "green", "blue", "pink", "grey"]);

  useEffect(() => {
     fetchBoxes();
  }, []);

  const fetchBoxes = async () => {
    let res = await getBoxes();
    setBoxes(res.data);
  };

  const shuffleColors = () => {
    setColors([...colors].sort(() => Math.random() - 0.5));
  };

  const sortBoxes = () => {
    const sorted = [...boxes].sort(
      (a, b) => colors.indexOf(a.color) - colors.indexOf(b.color)
    );
    setBoxes(sorted);
  };

  return (
    <div className="p-4">
      <h2>Colors: {colors.join(", ")}</h2>
      <button onClick={shuffleColors}>Shuffle Colours</button>
      <button onClick={sortBoxes} className="ml-2">Sort Boxes</button>

      <div className="mt-4 flex flex-wrap gap-2 m-2">
        {boxes.map((box, i) => (
          <div
            key={i}
            style={{
              height: box.height,
              width: box.width,
              backgroundColor: box.color,
              margin:'2px'
            }}
          ></div>
        ))}
      </div>
    </div>
  );
}
