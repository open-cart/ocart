const EventEmitter = {
    // holds all the events
    events : {},
    //for angular lovers
    emit : function(event, data){
        if(!this.events[event]) return;
        this.events[event].forEach(callback => callback.fn(data));
    },
    // for redux lovers
    dispatch : function(event, data){
        if(!this.events[event]) return;
        this.events[event].forEach(callback => callback.fn(data));
    },
    // for this module lovers
    subscribe : function(event, callback){
        if(!this.events[event]) this.events[event] = [];
        const item = {fn: callback}
        this.events[event].push(item);
        console.log(this.events)

        return {
            remove : function(){
                item.fn = () => {}
            }
        }
    }
}

export default EventEmitter;