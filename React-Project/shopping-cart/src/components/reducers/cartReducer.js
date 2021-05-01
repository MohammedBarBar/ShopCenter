// import Item1 from '../../images/1.png.webp';
// import Item2 from '../../images/2.png.webp';
// import Item3 from '../../images/3.png.webp';
// import Item4 from '../../images/4.png.webp';
// import Item5 from '../../images/5.png.webp';
// import Item6 from '../../images/6.png.webp';
// import Home from '../../components/Home';
// import data from '../../data/data';

// const testData = require('../../data/data.json');
// console.log(testData);
// var arr = data[0];
// var dataItem = arr[0];
const initState = {
    items: [],

    // {id:1,title:'Winter body', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price:110,img:Item1}
    //     {id:1,title:'Winter body', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price:110,img:Item1},
    //     {id:2,title:'Adidas', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price:80,img: Item2},
    //     {id:3,title:'Vans', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.",price:120,img: Item3},
    //     {id:4,title:'White', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price:260,img:Item4},
    //     {id:5,title:'Cropped-sho', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price:160,img: Item5},
    //     {id:6,title:'Blues', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.",price:90,img: Item6}
    // ],
    addedItems:[],
    total: 0

}
function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;
  
    // While there remain elements to shuffle...
    while (0 !== currentIndex) {
  
      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;
  
      // And swap it with the current element.
      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
    }
  
    return array;
  }
// localStorage.setItem('tt',JSON.stringify(initState.addedItems));
const cartReducer= (state = initState,action)=>{


    if(action.type === 'ADD_TO_ADDEDITEMS'){
        // console.log(action.data);
        // let s = state.items.push(action.data);
        state.addedItems = action.data;
        // console.log(state.items);
        return{
            ...state,
        }
    }

    if(action.type === 'ADD_TO_ITEMS'){
        // console.log(action.data);
        // let s = state.items.push(action.data);
        state.items = action.data;
        shuffle(state.items);
        // console.log(state.items);
        return{
            ...state
        }
    }
    if(action.type === 'ADD_TO_TOTALPRICE'){
        state.total = action.data
        return{
            ...state
        }
    }
    
    //INSIDE HOME COMPONENT
    if(action.type === 'ADD_TO_CART'){
        // console.log(state.items);
        // console.log(action.id);
        let addedItem = state.items.find(item=> item.idProducts === action.id)
        addedItem.price = Number.parseInt(addedItem.price);
        //check if the action id exists in the addedItems
        //  console.log(state.addedItems);
       let existed_item= state.addedItems.find(item=> action.id === item.idProducts)
       if(existed_item)
       {
        existed_item.quantity += 1 
        // localStorage.setItem('cardAdded',JSON.stringify());
           return{
              ...state,
               total: state.total + existed_item.price 
                }
      }
       else{
          addedItem.quantity = 1;
          //calculating the total
        //   localStorage.setItem('cardAdded',JSON.stringify(addedItem));
        // localStorage.setItem('cardAdded',JSON.stringify([...state.addedItems, addedItem]));
          let newTotal = state.total + addedItem.price 
          
          return{
              ...state,
              addedItems: [...state.addedItems, addedItem],
              total : newTotal
          }
      }
  }
  if(action.type === 'REMOVE_ITEM'){
    let itemToRemove= state.addedItems.find(item=> action.id === item.idProducts);
    let new_items = state.addedItems.filter(item=> action.id !== item.idProducts);
    // itemToRemove.price = Number.parseInt(itemToRemove.price);
    // console.log(itemToRemove);

    
    //calculating the total
    let newTotal = state.total - (itemToRemove.price * itemToRemove.quantity );
    return{
        ...state,
        addedItems: new_items,
        total: newTotal
    }
}
//INSIDE CART COMPONENT
if(action.type=== 'ADD_QUANTITY'){
    console.log(state.addedItems);
    // console.log(action.id);
    let addedItem = state.addedItems.find(item=> item.idProducts === action.id)
    // console.log(addedItem);
    // console.log(addedItem.quantity);
      addedItem.quantity += 1 
    //   console.log(addedItem);
      let newTotal = state.total + addedItem.price
      return{
          ...state,
          total: newTotal
      }
}
if(action.type=== 'SUB_QUANTITY'){  
    let addedItem = state.addedItems.find(item=> item.idProducts === action.id) 
    //if the qt == 0 then it should be removed
    if(addedItem.quantity === 1){
        let new_items = state.addedItems.filter(item=>item.idProducts !== action.id)
        let newTotal = state.total - addedItem.price
        return{
            ...state,
            addedItems: new_items,
            total: newTotal
        }
    }
    else {
        addedItem.quantity -= 1
        let newTotal = state.total - addedItem.price
        return{
            ...state,
            total: newTotal
        }
    }
    
}

if(action.type=== 'ADD_SHIPPING'){
      return{
          ...state,
          total: state.total + 10
      }
}

if(action.type=== 'SUB_SHIPPING'){
    return{
        ...state,
        total: state.total - 10
    }
}

  else{
      return state
  }

}

export default cartReducer;